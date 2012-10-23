
import java.io.*;
import java.net.*;

public class Main {

    protected void start() {
        ServerSocket s;

        try {
            s = new ServerSocket(9100);
        } catch (Exception e) {
            System.out.println("Error: " + e);
            return;
        }

        System.out.println("Warte auf Verbindung...");

        for (;;) {
            try {
                Socket remote = s.accept();
                BufferedReader in = new BufferedReader(new InputStreamReader(
                        remote.getInputStream()));
                PrintWriter out = new PrintWriter(remote.getOutputStream());

                String str = ".";
                while (!str.equals("")) {
                    str = in.readLine();
                    System.out.println(str);
                }
                out.println("Hallo Du");
                out.flush();
                remote.close();
            } catch (Exception e) {
                System.out.println("Error: " + e);
            }
        }
    }

    public static void main(String args[]) {
        Main thread = new Main();
        thread.start();
    }
}
