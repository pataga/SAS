#!/usr/bin/ruby
require 'logger'  
require 'soap/rpc/standaloneServer'  



class SASSoap < SOAP::RPC::StandaloneServer  
  $newsCount = 9

  def initialize(* args)  
    super  
    add_method(self, 'Install', 'key', 'packet') 
    add_method(self, 'Execute', 'key', 'cmd') 
    add_method(self, 'GetNoticeCount', 'key')
    add_method(self, 'Alive', 'key')
    @log = Logger.new("SASDaemon.log", 5, 10*1024)  
  end 

  def Alive(key) 
    if !Auth(key)
      Log('Connection failed')
      return false;
    end
    return true
  end

  def Auth(key)
    data = open('SASDaemon.access', "r")
    _key = data.read.chomp
    if _key == key.chomp
      return true
    else
      return false
    end

    data.close
  end 

  def Execute(key, cmd)
    if !Auth(key)
      Log('Connection failed')
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
      Log('Connection failed')
      return false;
    end
      
    Thread.new {
      a = `apt-get install #{packet} -yf`
      $newsCount++
      Log("Packet "+packet+" wurde installiert")
    }
    $newsCount = $newsCount+1
    return "Installation wird eingeleitet"
  end

  def GetNoticeCount(key)
    if !Auth(key)
      Log('Connection failed')
      return false;
    end
      
    return $newsCount
  end
end  

def printRed(msg)
  system("echo '[SASDaemon]\\033[31;1m #{msg} \\033[37;1m \n'")
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
    


host = "127.0.0.1"
port = "9000"
user = `whoami`.chomp
if user != 'root'
  printRed("Der Daemon muss als ROOT ausgeführt werden")
  exit
end
puts "[SASDaemon] Initialisiere SOAP Server...."
puts "[SASDaemon] Listen on "+host+":"+port
server = SASSoap.new('SASRubySoap','urn:SASSoap',host,port)  
trap('INT') {server.shutdown}  
puts "[SASDaemon] SOAP Server bereit"
server.start  
puts '[SASDaemon] SASDaemon stopped'
