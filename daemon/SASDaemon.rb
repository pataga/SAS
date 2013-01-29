#!/usr/bin/ruby
require 'logger'  
require 'soap/rpc/standaloneServer'  



class SASSoap < SOAP::RPC::StandaloneServer  
  $newsCount = 0

  def initialize(* args)  
    super  
    add_method(self, 'Install', 'key', 'packet') 
    add_method(self, 'Execute', 'key', 'cmd') 
    add_method(self, 'GetNoticeCount', 'key')
    @log = Logger.new("SASDaemon.log", 5, 10*1024)  
  end 

  def Auth(key)
    data = open('data.sas', "r")
    _key = data.read

    if _key == key
      return true
    else
      return false
    end

    data.close
  end 

  def Execute(key, cmd)
    if !Auth(key)
      return false;
    end

    t = Time.now  
    Log("Befehl "+cmd+" wurde verwendet") 
    a = `#{cmd}`
    return a
  end

  def Log(msg)  
    t = Time.now  
    @log.info("#{msg} um #{t}")  
  end  

  def Install(key, packet)
    if !Auth(key)
      return false;
    end
      
    Thread.new {
      a = `apt-get install #{packet} -yf`
      Log("Packet "+packet+" wurde installiert")
    }
    $newsCount = $newsCount+1
    return "Installation wird eingeleitet"
  end

  def GetNoticeCount(key)
    if !Auth(key)
      return false;
    end
      
    return $newsCount
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
    
puts "Initialisiere SOAP Server...."
server = SASSoap.new('SASRubySoap','urn:SASSoap','0.0.0.0',9000)  
trap('INT') {server.shutdown}  
puts "SOAP Server bereit"
server.start  
puts server
