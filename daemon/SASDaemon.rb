#!/usr/bin/ruby
require 'logger'  
require 'soap/rpc/standaloneServer'  



class SASSoap < SOAP::RPC::StandaloneServer  
  $someNews = 0

  def initialize(* args)  
    super  
    add_method(self, 'Hallo', 'username')  
    add_method(self, 'Install', 'packet') 
    add_method(self, 'Execute', 'cmd') 
    add_method(self, 'GetNotices')
    @log = Logger.new("soapserver.log", 5, 10*1024)  
  end  

  def Execute(cmd)
    t = Time.now  
    Log("Befehl "+cmd+" wurde verwendet") 
    a = `#{cmd}`
    return a
  end

  def Log(msg)  
    t = Time.now  
    @log.info("#{msg} um #{t}")  
  end  

  def Install(packet)
    Thread.new {
      a = `apt-get install #{packet} -yf`
      Log("Packet "+packet+" wurde installiert")
    }
    $someNews = $someNews+1
    return "Installation wird eingeleitet"
  end

  def GetNotices()
    return $someNews
  end
end  


  

puts("########################################################################\n\n");
puts("#         ********     **      ********                                # \n");
puts("#        **//////     ****    **//////                                 # \n");
puts("#       /**          **//**  /**                                       # \n");
puts("#       /*********  **  //** /*********                                # \n");
puts("#       ////////** **********////////**                                # \n");
puts("#              /**/**//////**       /**                                # \n");
puts("#        ******** /**     /** ********                                 # \n");
puts("#       ////////  //      // ////////                                  # \n");
puts("#        *******                                                       # \n");                       
puts("#       /**////**                                                      # \n");                          
puts("#       /**    /**  ******    *****  **********   ******  *******      # \n");
puts("#       /**    /** //////**  **///**//**//**//** **////**//**///**     # \n");
puts("#       /**    /**  ******* /******* /** /** /**/**   /** /**  /**     # \n");
puts("#       /**    **  **////** /**////  /** /** /**/**   /** /**  /**     # \n");
puts("#       /*******  //********//****** *** /** /**//******  ***  /**     # \n");
puts("#       ///////    ////////  ////// ///  //  //  //////  ///   //      # \n\n");
puts("########################################################################\n\n\n");
    

server = SASSoap.new('SASRubySoap','urn:SASSoap','0.0.0.0',9000)  
trap('INT') {server.shutdown}  
puts "Initialisiere SOAP Server...."
server.start  
