import java.io.*;
import java.util.*;
import java.net.*;
//import javax.mail.*;
import java.util.Properties;
//import javax.mail.internet.*;

/*class EmailUtility{
    public static void sendEmail (String to, String subject, String body) throws MessagingException{
        //some stuff here

    }
}*/

class School {
    private String RegistrationNumber;
    private String name;
    private String district;
    private String representative;
    private String email;

    public School(String RegistrationNumber, String name, String district, String representative, String email) {
        this.RegistrationNumber = RegistrationNumber;
        this.name = name;
        this.district = district;
        this.representative = representative;
        this.email = email;
    }
    public String getRegistrationNumber(){
        return RegistrationNumber;
    }
    public String getEmail(){
        return email;
    }
    public String getRepresentative(){
        return representative;
    }
}
class Participant{
    String UserName;
    String FirstName;
    String LastName;
    String Email;
    String DateOfBirth;
    // image part
    String SchoolRegNo;
    String password;
    public Participant(String UserName, String FirstName, String LastName, String Email, String DateOfBirth, String SchoolRegNo, String password){
        this.UserName = UserName;
        this.FirstName = FirstName;
        this.LastName = LastName;
        this.Email = Email;
        this.DateOfBirth = DateOfBirth;
        this.SchoolRegNo = SchoolRegNo;
        this.password = password;
    }

}
class Challenge{
    private String challengeId;
    private String challengeName;
    private String startDate;
    private String endDate;
    public Challenge(String challengeId, String challengeName, String startDate, String endDate){
        this.challengeId = challengeId;
        this.challengeName = challengeName;
        this.startDate = startDate;
        this.endDate = endDate;
    }
}

public class Server {
    private static final int PORT = 12345;
    private static Map<String, School> schools = new HashMap<>();
    private static List<Participant> waitingParticipants = new ArrayList<>();
    private static Map<String, Participant> confirmedParticipants = new HashMap<>();
    private static Map<String, String> representatives = new HashMap<>();
    private static Map<String, String> challenges = new HashMap<>();


    public static void main(String[] args) {
        try {
            loadSchoolsAndRepresentatives("schools.csv");
            loadchallenges("challenges.csv");
        } catch (IOException e){
            e.printStackTrace();
        }
        try (ServerSocket serverSocket = new ServerSocket(PORT)) {
            System.out.println("Server Started......");
            while (true) {
                new ClientHandler(serverSocket.accept()).start();

            }
        } catch (IOException e) {
            e.printStackTrace();
        }

    }

    private static void loadSchoolsAndRepresentatives(String fileName) throws IOException {
        try (BufferedReader br = new BufferedReader(new FileReader(fileName))) {
            String line;
            while ((line = br.readLine()) != null) {
                String[] parts = line.split(",");
                if (parts.length == 6) {
                    String schoolRegNumber = parts[0];
                    String schoolName = parts[1];
                    String district = parts[2];
                    String representativeName = parts[3];
                    String email = parts[4];
                    String representativePassword = parts[5];
                    School school = new School(schoolRegNumber, schoolName, district, representativeName, email);
                    schools.put(schoolRegNumber, school);
                    representatives.put(representativeName, representativePassword);
                }
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    private static void loadchallenges(String filename)throws IOException{
        try(BufferedReader br =new BufferedReader(new FileReader(filename))){
            String line;
            while((line = br.readLine()) !=null){
                String[] parts = line.split(",");
                if(parts.length == 4){
                    String challengeId = parts[0];
                    String challengeName = parts[1];
                    String startDate = parts[2];
                    String endDate = parts[3];
                    Challenge challenge = new Challenge(challengeId,challengeName, startDate, endDate);
                    challenges.put(challengeId,challengeName);
                }
            }
        }catch (IOException e){
            e.printStackTrace();
        }
    }

    public static Map<String, School> getSchools() {
        return schools;
    }

    public static void addWaitingParticipant(Participant participant) {
        waitingParticipants.add(participant);
    }

    public static void addConfirmedParticipant(Participant participant) {
        confirmedParticipants.put(participant.UserName, participant);
    }

    public static List<Participant> getWaitingParticipants() {
        return waitingParticipants;
    }

    public static Map<String, Participant> getConfirmedParticipants() {
        return confirmedParticipants;
    }

    public static Map<String, String> getRepresentatives() {
        return representatives;
    }


    static class ClientHandler extends Thread {
        private Socket socket;
        private BufferedReader in;
        private PrintWriter out;
        private String userType;
        private Participant loggedInPupil;

        public ClientHandler(Socket socket) {

            this.socket = socket;
        }


        public void run() {
            try {
                in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
                out = new PrintWriter(socket.getOutputStream(), true);
                viewMenu();
                String command;
                while ((command = in.readLine()) != null) {
                    executeCommand(command);
                }
            } catch (IOException e) {
                e.printStackTrace();
            } finally {
                try {
                    socket.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }
        private void viewMenu(){
            out.println("Welcome to the IES mathematics challenge");
            out.println("Please use the following commands to do your bidding.");
            out.println("1. Register Username FirstName LastName Email DateOfBirth(dd-mm-YYYY) SchoolRegNo Password");
            out.println("2. Login Username Password");
            out.println("3. ViewChallenges");
            out.flush();
        }

        private void executeCommand(String command) {
            String[] parts = command.split(" ");
            switch (parts[0]) {
                case "Register":
                    registerParticipant(parts);
                    break;
                case "Login":
                    Login(parts);
                    break;
                case "ViewChallenges":
                    viewChallenges();
                case "Confirm":
                    if ("representative".equalsIgnoreCase(userType)) {
                        confirmParticipant(parts);
                    } else {
                        out.println("Command can only be used by representatives");
                    }
                    break;
                case "ViewParticipants":
                    if ("representative".equalsIgnoreCase(userType)) {
                        viewParticipants();
                    } else {
                        out.println("Command can only be used representatives");
                    }
                    break;
                case "AttemptChallenge":
                    if (loggedInPupil != null && "pupil".equalsIgnoreCase(userType)) {
                        attemptChallenge(parts);
                    } else {
                        out.println("Not registered or not logged in");
                    }
                    break;
                default:
                    out.println("Unknown command");
            }
            out.flush();
        }

        private void registerParticipant(String[] parts) {
            if (parts.length < 8) {
                out.println("Incomplete Registration Details");
                return;
            }
            String UserName = parts[1];
            String FirstName = parts[2];
            String LastName = parts[3];
            String Email = parts[4];
            String DateOfBirth = parts[5];
            String schoolRegNumber = parts[6];
            String password = parts[7];

            School school = Server.getSchools().get(schoolRegNumber);
            if (school != null) {
                Participant participant = new Participant(UserName, FirstName, LastName, Email, DateOfBirth, schoolRegNumber, password);
                Server.addWaitingParticipant(participant);
                out.println("Registration complete: Please wait for representative confirmation to login");
            /*try{
                EmailUtility.sendEmail(school.getEmail(), "New Participant registration", "please confirm the registration of "+UserName);
            }catch (MessagingException e){
                e.printStackTrace();
                out.println("Confirmation email not sent");
            }*/
            } else {
                out.println("School Registration number  not found");
            }
        }

        private void Login(String[] parts) {
            if (parts.length < 3) {
                out.println("Incomplete Login Details");
                return;
            }
            String Username = parts[1];
            String password = parts[2];
            if (Server.getRepresentatives().containsKey(Username) && Server.getRepresentatives().get(Username).equals(password)) {
                userType = "Representative";
                out.println("Representative Login Success");
                out.println("Commands for use are:");
                out.println("Confirm (username yes/no)");
                out.println("ViewParticipants");
            } else {
                Participant participant = Server.getConfirmedParticipants().get(Username);
                if (participant != null && participant.password.equals(password)) {
                    userType = "Pupil";
                    loggedInPupil = participant;
                    out.println("Participant Login Success");
                    out.println("Commands for use:");
                    out.println("ViewChallenges");
                    out.println("AttemptChallenge(challengeId)");
                } else {
                    out.println("You are not confirmed/Invalid Credentials");
                }
            }
        }

        private void viewChallenges() {
            if (loggedInPupil == null && !"Representative".equalsIgnoreCase(userType)) {
                out.println("Not registered/Not Logged in");
                return;
            }
            out.println("Open challenges:");
            for(Map.Entry<String,String> entry : challenges.entrySet()){
                out.println("challenge ID:"+entry.getKey()+"-"+entry.getValue());
            }

        }

        private void attemptChallenge(String[] parts) {
            if (parts.length < 2) {
                out.println("Incomplete Command request");
                return;
            }
            String challengeId = parts[1];
            if(challenges.containsKey(challengeId)){
                out.println("Starting Challenge" +challenges.get(challengeId)+".....");

            }else {

                out.println("Challenge not found");
            }
        }


        private void confirmParticipant(String[] parts) {
            if (parts.length < 3) {
                out.println("Incomplete Command request");
                return;
            }
            String Username = parts[1];
            boolean confirmed = "yes".equalsIgnoreCase(parts[2]);
            Iterator<Participant> iterator = Server.getWaitingParticipants().iterator();
            while (iterator.hasNext()) {
                Participant participant = iterator.next();
                if (participant.UserName.equals(Username)) {
                    iterator.remove();
                    if (confirmed) {
                        Server.addConfirmedParticipant(participant);
                        out.println("Participant confirmed");
                  /*  try{
                        EmailUtility.sendEmail(participant.email, "Registration Confirmed","Your registration has been confirmed. you can login");
                    }catch (MessagingException e){
                        e.printStackTrace();
                        out.println("Confirmation email not sent");
                    }*/
                    } else {
                        out.println("Participant Rejected");
                  /*  try{
                        EmailUtility.sendEmail(participant.email, "Registration Rejected","Your registration has been rejected");
                    }catch (MessagingException e){
                        e.printStackTrace();
                        out.println("Rejection email not sent");
                }*/
                    }
                    return;
                }
            }
            out.println("Participant not found");

        }

        private void viewParticipants() {
            out.println("Waiting Participants:");
            for (Participant p : Server.getWaitingParticipants()) {
                out.println(p.UserName + "-" + p.FirstName + "" + p.LastName + "-" + p.SchoolRegNo);
            }
            out.println("Confirmed Participants:");
            for (Participant p : Server.getConfirmedParticipants().values()) {
                out.println(p.UserName + "-" + p.FirstName + "" + p.LastName + "-" + p.SchoolRegNo);
            }
        }

    }
}