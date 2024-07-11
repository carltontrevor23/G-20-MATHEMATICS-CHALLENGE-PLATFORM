import java.io.*;
import java.net.*;
import java.util.Scanner;

public class Client {
    private static final String SERVER_ADDRESS = "localhost";
    private static final int SERVER_PORT = 12345;

    public static void main(String[] args) {
        try(Socket Socket = new Socket(SERVER_ADDRESS, SERVER_PORT)){

            BufferedReader in = new BufferedReader(new InputStreamReader(Socket.getInputStream()));
            PrintWriter out = new PrintWriter(Socket.getOutputStream(), true);

            String line;
            while ((line = in.readLine()) != null) {
                System.out.println(line);
                if (line.equals("3. ViewChallenges")) {
                    break;
                }
            }
            Scanner scanner = new Scanner(System.in);
            while (true) {
                System.out.print("> ");
                String command = scanner.nextLine();
                out.println(command);

                while ((line = in.readLine()) != null) {
                    System.out.println(line);
                    if(line.isEmpty() || line.equals(">")){
                        break;
                    }
                }
            }

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}