import java.io.*;
import java.net.*;
import java.util.Scanner;

public class Client {
    private static final String SERVER_ADDRESS = "localhost"; // Change this to the server's IP address if running on a different machine
    private static final int SERVER_PORT = 12345;

    public static void main(String[] args) {
        try (Socket socket = new Socket(SERVER_ADDRESS, SERVER_PORT);
             BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
             PrintWriter out = new PrintWriter(socket.getOutputStream(), true);
             Scanner scanner = new Scanner(System.in)) {

            // Read welcome message and commands from the server
            String line;
            while ((line = in.readLine()) != null && !line.isEmpty()) {
                System.out.println(line);
            }

            // Interact with the server based on user input
            while (true) {
                System.out.print("> ");
                String command = scanner.nextLine();
                out.println(command);

                if (command.equalsIgnoreCase("exit")) {
                    break;
                }

                // Read and display the server's response
                while ((line = in.readLine()) != null && !line.isEmpty()) {
                    System.out.println(line);
                }
            }

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}

