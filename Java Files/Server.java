//necessary resources for the server code
import java.io.*;
import java.nio.file.Files;
import java.util.*;
import java.net.*;
import java.sql.*;
import java.nio.file.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import javax.mail.*;
import java.util.Properties;
import javax.mail.Authenticator;
import javax.mail.internet.*;
import javax.mail.PasswordAuthentication;
import java.io.IOException;
import java.time.Duration;
import java.time.Instant;
import java.util.ArrayList;
import java.util.List;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;
import java.io.FileOutputStream;




//a class to handle the sending of the emails to throughout the program cycle
class EmailUtility {
    private static final String SMTP_SERVER = "smtp.gmail.com";
    private static final String USERNAME = "tgnsystemslimited@gmail.com";
    private static final String PASSWORD = "anls iqfv zxwt irfq";
    private static final String FROM_EMAIL = "tgnsystemslimited@gmail.com";

    //method that is called specifically to perform the email sending
    public static void sendEmail(String to, String subject, String body) throws MessagingException {
        Properties properties = new Properties();
        properties.put("mail.smtp.host","smtp.gmail.com");
        properties.put("mail.smtp.port", "465");
        properties.put("mail.smtp.auth", "true");
        properties.put("mail.smtp.starttls.enable", "true");
        properties.put("mail.smtp.socketFactory.class", "javax.net.ssl.SSLSocketFactory");
        //properties.put("mail.smtp.socketFactory.fallback", "false");
        properties.put("mail.smtp.ssl.enable", "true"); // Enable SSL
        properties.put("mail.smtp.ssl.trust", "smtp.gmail.com");
        properties.put("mail.smtp.ssl.protocols", "TLSv1.2");
        properties.put("mail.smtp.debug", "true");

        Session session = Session.getInstance(properties, new Authenticator() {
            // @Override
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(USERNAME, PASSWORD);
            }
        });
        try {
            Message message = new MimeMessage(session);
            message.setFrom(new InternetAddress(FROM_EMAIL));
            message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(to));
            message.setSubject(subject);
            message.setText(body);

            Transport.send(message);
            System.out.println("Email sent successfully!");
        } catch (MessagingException e) {
            System.err.println("Error sending email: " + e.getMessage());
        }

    }
    public static void sendEmailWithAttachment(String to, String subject, String body, String attachmentFilePath)
            throws MessagingException, IOException {

        Properties properties = new Properties();
        properties.put("mail.smtp.host","smtp.gmail.com");
        properties.put("mail.smtp.port", "465");
        properties.put("mail.smtp.auth", "true");
        properties.put("mail.smtp.starttls.enable", "true");
        properties.put("mail.smtp.socketFactory.class", "javax.net.ssl.SSLSocketFactory");
        //properties.put("mail.smtp.socketFactory.fallback", "false");
        properties.put("mail.smtp.ssl.enable", "true"); // Enable SSL
        properties.put("mail.smtp.ssl.trust", "smtp.gmail.com");
        properties.put("mail.smtp.ssl.protocols", "TLSv1.2");
        properties.put("mail.smtp.debug", "true");

        Session session = Session.getInstance(properties, new Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(USERNAME, PASSWORD);
            }
        });
        try {
            Message message = new MimeMessage(session);
            message.setFrom(new InternetAddress(FROM_EMAIL));
            message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(to));
            message.setSubject(subject);

            // Create the message body part
            MimeBodyPart messageBodyPart = new MimeBodyPart();
            messageBodyPart.setText(body);

            // Create the attachment body part
            MimeBodyPart attachmentBodyPart = new MimeBodyPart();
            attachmentBodyPart.attachFile(new File(attachmentFilePath));

            // Create multipart
            Multipart multipart = new MimeMultipart();
            multipart.addBodyPart(messageBodyPart);
            multipart.addBodyPart(attachmentBodyPart);

            // Set the multipart as the message's content
            message.setContent(multipart);

            // Send message
            Transport.send(message);
            System.out.println("Email with attachment sent successfully!");

        } catch (MessagingException | IOException e) {
            System.err.println("Error sending email with attachment: " + e.getMessage());
            throw e; // Rethrow the exception to propagate it to the caller
        }
    }
}

// school and its details or attributes as an entity
class School {
    private String registration_number;
    private String name;
    private String district;
    private String representative_name;
    private String email;
    private String representative_password;
    //school constructor
    public School(String registration_number, String name, String district, String representative_name, String email, String representative_password) {
        this.registration_number = registration_number;
        this.name = name;
        this.district = district;
        this.representative_name = representative_name;
        this.email = email;
        this.representative_password = representative_password;
    }
    //getters and setters for the class school
    public String getregistration_number(){
        return registration_number;
    }
    public String getName(){
        return name;
    }
    public String getDistrict(){
        return district;
    }
    public String getEmail(){
        return email;
    }
    public String getRepresentative_name(){
        return representative_name;
    }
    public String getRepresentative_password(){
        return representative_password;
    }
}
//representing details of a participant
class Participant{
    String username;
    String firstname;
    String lastname;
    String email;
    String date_of_birth;
    String registration_number;
    byte[] image;
    String password;
    //constructor
    public Participant(String username, String firstname, String lastname, String email, String date_of_birth, String registration_number, byte[] image, String password){
        this.username = username;
        this.firstname = firstname;
        this.lastname = lastname;
        this.email = email;
        this.date_of_birth= date_of_birth;
        this.registration_number = registration_number;
        this.image = image;
        this.password = password;
    }
    // getters of the class participant
    public String getEmail() {
        return email;
    }
    public String getFirstname(){
        return firstname;
    }

    public String getUsername() {
        return username;
    }

    public String getRegistration_number() {
        return registration_number;
    }
}
//details and attributes of class challenges
class Challenges{
    private String id;
    private String name;
    private String start_date;
    private String end_date;
    private int number_of_questions;
    private String duration;
    //constructor
    public Challenges(String id, String name, String start_date, String end_date, int number_of_questions, String duration){
        this.id = id;
        this.name = name;
        this.start_date = start_date;
        this.end_date = end_date;
        this.number_of_questions = number_of_questions;
        this.duration =duration;
    }
    public String toString(){
        return "ChallengeId"+id+ "name"+name+ "startdate"+start_date+ "endDate"+end_date+ "Questions"+number_of_questions+ "Time"+duration;
    }
}
//managing all database connections through one class.
//static methods for instances of connections
class Database{
    private static final String DB_URL = "jdbc:mysql://localhost:3306/mathematics-challenge";
    private static final String DB_USER = "root";
    private static final String DB_PASSWORD = "";
    static {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            System.err.println("jdbc not found");
            e.printStackTrace();
        }
    }
    public static Connection getConnection() throws SQLException{
        return  DriverManager.getConnection(DB_URL,DB_USER,DB_PASSWORD);
    }
}
/*
   Main server class handling communication with clients.
   Uses multithreading to handle multiple client connections simultaneously.
*/

public class server {
    private static final int PORT = 12345;
    private static Map<String, School> schools = new HashMap<>();
    private static List<Participant> waitingParticipants = new ArrayList<>();
    private static Map<String, Participant> confirmedParticipants = new HashMap<>();
    private static Map<String, String> challenges = new HashMap<>();

    //main method to handle incoming client connections
    public static void main(String[] args) {
        try {
            loadSchoolsAndRepresentatives();
            loadchallenges();
            //getting data from the database
        } catch (SQLException e) {
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
    //method body for getting data from the tables in the database
    private static void loadSchoolsAndRepresentatives() throws SQLException {
        String query = "SELECT * FROM schools";
        try {
            Connection connection = Database.getConnection();
            Statement statement = connection.createStatement();
            ResultSet resultSet = statement.executeQuery(query);
            while (resultSet.next()) {
                String registration_number = resultSet.getString("registration_number");
                String name = resultSet.getString("name");
                String district = resultSet.getString("district");
                String representative_name = resultSet.getString("representative_name");
                String email = resultSet.getString("email");
                String representative_password = resultSet.getString("representative_password");

                School school = new School(registration_number, name, district, representative_name, email, representative_password);
                schools.put(registration_number, school);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private static void loadchallenges() throws SQLException {
        String query = "SELECT * FROM challenges";
        try (Connection connection = Database.getConnection()) {
            Statement statement = connection.createStatement();
            ResultSet resultSet = statement.executeQuery(query);
            while (resultSet.next()) {
                String id = resultSet.getString("id");
                String name = resultSet.getString("challenge_name");
                String start_date = resultSet.getString("start_date");
                String end_date = resultSet.getString("end_date");
                int number_of_questions = resultSet.getInt("number_of_questions");
                String duration = resultSet.getString("duration");
                Challenges challenge = new Challenges(id, name, start_date, end_date, number_of_questions,duration);
                challenges.put(id, name);
            }
        }
    }
    //methods to access data,manipulate schools, participants and challenges
    public static Map<String, School> getSchools() {
        return schools;
    }

    public static void addWaitingParticipant(Participant participant) {
        waitingParticipants.add(participant);
        saveToTempFile(participant);

        // Send email to school representative
        School school = schools.get(participant.getRegistration_number());
        if (school != null) {
            try {
                EmailUtility.sendEmail(school.getEmail(), "New Participant Registration",
                        "Please confirm the registration of " + participant.getUsername());
            } catch (MessagingException e) {
                e.printStackTrace();
                System.out.println("Error sending confirmation email to school representative");
            }
        }
    }

    public static void addConfirmedParticipant(Participant participant){
        confirmedParticipants.put(participant.username, participant);

        // Send confirmation email to participant
        try {
            EmailUtility.sendEmail(participant.getEmail(), "Registration Confirmation",
                    "Thank you for choosing Mathematics Challenge Platform. Your registration has been confirmed by your school representative. Please log in to access challenges.");
        } catch (MessagingException e) {
            e.printStackTrace();
            System.out.println("Error sending confirmation email to participant");
        }
    }

    public static List<Participant> getWaitingParticipants() {
        return waitingParticipants;
    }

    public static Map<String, Participant> getConfirmedParticipants() {
        return confirmedParticipants;
    }

    //method to save pending participants to a temporary file
    private static void saveToTempFile(Participant participant) {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter("temp-registrations.txt", true))) {
            writer.write(participant.username + "," + participant.firstname + "," + participant.lastname + "," + participant.email + "," + participant.date_of_birth + "," + participant.registration_number + "," + participant.password + "\n");
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    //nested class to handle client connections and commands
    static class ClientHandler extends Thread {
        private Socket socket;
        private BufferedReader in;
        private PrintWriter out;
        private String userType;
        private Participant loggedInPupil;
        private boolean loggedIn = false;
        private ChallengeAttempt currentChallenge;


        public ClientHandler(Socket socket) {

            this.socket = socket;
        }

        //method to interact with client
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

        private void viewMenu() {
            out.println("Welcome to the Mathematics Challenge Platform");
            out.println("Please use the following commands to do your bidding.");
            out.println("1. Register Username FirstName LastName Email DateOfBirth(dd-mm-YYYY) SchoolRegNo imagepath Password");
            out.println("2. Login Username Password");
            out.println("3. ViewChallenges");
            out.println("4. Logout");
            out.flush();
        }

        //different commands and their use scenarios
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
                    if (loggedIn) {
                        viewChallenges();
                    } else {
                        out.println("You are not logged in");
                    }
                    break;
                case "Confirm":
                    if ("Representative".equalsIgnoreCase(userType) && loggedIn) {
                        confirmParticipant(parts);
                    } else {
                        out.println("Command can only be used by representatives");
                    }
                    break;
                case "ViewParticipants":
                    if ("Representative".equalsIgnoreCase(userType) && loggedIn) {
                        viewParticipants();
                    } else {
                        out.println("Command can only be used representatives");
                    }
                    break;
                case "AttemptChallenge":
                    if (loggedInPupil != null && "pupil".equalsIgnoreCase(userType)) {
                        try {
                            attemptChallenge(parts);
                        } catch (IOException e) {
                            throw new RuntimeException(e);
                        }
                    } else {
                        out.println("Not registered or not logged in");
                    }
                    break;
                case "Logout":
                    logout();
                    break;
                default:
                    out.println("Unknown command");
            }
            out.flush();
        }

        private void logout() {
            userType = null;
            loggedInPupil = null;
            loggedIn = false;
            currentChallenge = null;
            out.println("You have been logged out.");
            viewMenu();
        }

        //methods to handle the specific client commands
        private void registerParticipant(String[] parts) {
            if (parts.length < 9) {
                out.println("Incomplete Registration Details");
                return;
            }
            String username = parts[1];
            String firstname = parts[2];
            String lastname = parts[3];
            String email = parts[4];
            String date_of_birth = parts[5];
            String registration_number = parts[6];
            String imagePath = parts[7];
            String password = parts[8];
            try {
                byte[] image = Files.readAllBytes(Paths.get(imagePath));
                School school = server.getSchools().get(registration_number);
                if (school != null) {
                    Participant participant = new Participant(username, firstname, lastname, email, date_of_birth, registration_number, image, password);
                    server.addWaitingParticipant(participant);
                    out.println("Registration complete: Please wait for representative confirmation to login");
                    try {
                        EmailUtility.sendEmail(school.getEmail(), "New Participant Registration", "Please confirm the registration of " + username);
                    } catch (MessagingException e) {
                        e.printStackTrace();
                        out.println("Confirmation email not sent");
                    }

                } else {
                    out.println("School Registration number  not found");
                }
            } catch (IOException e) {
                e.printStackTrace();
                out.println("Error reading Image File");
            }
        }

        private byte[] readImageFile(String imagePath) throws IOException {
            Path path = Paths.get(imagePath);
            return Files.readAllBytes(path);
        }

        private void Login(String[] parts) {
            if (parts.length < 3) {
                out.println("Incomplete Login Details");
                return;
            }
            String Username = parts[1];
            String password = parts[2];
            boolean isRepresentative = false;
            try (Connection connection = Database.getConnection()) {
                PreparedStatement statement = connection.prepareStatement("SELECT representative_password FROM schools WHERE representative_name = ?");
                statement.setString(1, Username);
                ResultSet resultSet = statement.executeQuery();
                if (resultSet.next()) {
                    String repPassword = resultSet.getString("representative_password");
                    if (repPassword.equals(password)) {
                        isRepresentative = true;
                        userType = "Representative";
                        loggedIn = true;
                        out.println("Representative Login Success");
                        out.println("Commands for use are:");
                        out.println("Confirm (username yes/no)");
                        out.println("ViewParticipants");
                    }
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
            if (!isRepresentative) {
                Participant participant = server.getConfirmedParticipants().get(Username);
                if (participant != null && participant.password.equals(password)) {
                    userType = "Pupil";
                    loggedInPupil = participant;
                    loggedIn = true;
                    out.println("Participant Login Success");
                    out.println("Commands for use:");
                    out.println("ViewChallenges");
                    out.println("AttemptChallenge(challengeId)");
                } else {
                    out.println("Login failed: You are not confirmed/Invalid Credentials");
                }
            }
        }

        private void viewChallenges() {
            if (loggedInPupil == null && !"Representative".equalsIgnoreCase(userType)) {
                out.println("Not registered/Not Logged in");
                return;
            }
            out.println("Open challenges:");
            try (Connection connection = Database.getConnection()) {
                String query = "SELECT id, challenge_name, start_date, end_date, number_of_questions, duration FROM challenges";
                Statement statement = connection.createStatement();
                ResultSet resultSet = statement.executeQuery(query);
                while (resultSet.next()) {
                    String id = resultSet.getString("id");
                    String name = resultSet.getString("challenge_name");
                    String startDate = resultSet.getString("start_date");
                    String endDate = resultSet.getString("end_date");
                    int numberOfQuestions = resultSet.getInt("number_of_questions");
                    String duration = resultSet.getString("duration");
                    out.println("Challenge ID: " + id);
                    out.println("Name: " + name);
                    out.println("Start Date: " + startDate);
                    out.println("End Date: " + endDate);
                    out.println("Number of Questions: " + numberOfQuestions);
                    out.println("Duration: " + duration);
                    out.println("-------------------------");
                }
            } catch (SQLException e) {
                e.printStackTrace();
                out.println("Error retrieving challenges: " + e.getMessage());
            }
            out.flush();
        }

        private void attemptChallenge(String[] parts) throws IOException {
            if (parts.length < 2) {
                out.println("Incomplete Command request");
                return;
            }
            String challengeId = parts[1];
            if (challenges.containsKey(challengeId)) {
                try (Connection connection = Database.getConnection()) {
                    // Check the number of attempts
                    String checkAttemptsQuery = "SELECT COUNT(*) AS attempt_count FROM attempts WHERE username = ? AND challenge_id = ?";
                    PreparedStatement checkStatement = connection.prepareStatement(checkAttemptsQuery);
                    checkStatement.setString(1, loggedInPupil.username);
                    checkStatement.setString(2, challengeId);
                    ResultSet resultSet = checkStatement.executeQuery();
                    int attempts = 0;
                    if (resultSet.next()) {
                        attempts = resultSet.getInt("attempt_count");
                    }

                    if (attempts >= 3) {
                        out.println("You have already attempted this challenge 3 times.");
                        return;
                    }
                } catch (SQLException e) {
                    e.printStackTrace();
                }
                out.println("Starting Challenge " + challenges.get(challengeId) + ".....");

                // Retrieve random 10 questions from the database
                List<Question> questions = getRandomQuestions(challengeId);
                currentChallenge = new ChallengeAttempt(questions);
                StringBuilder questionsAttempted = new StringBuilder();
                StringBuilder answersGiven = new StringBuilder();
                Instant start = Instant.now();

                for (int i = 0; i < questions.size(); i++) {
                    Question question = questions.get(i);
                    out.println((i + 1) + ". " + question.getQuestionText());
                    out.println("Enter your answer:");
                    String answer = in.readLine();
                    currentChallenge.setAnswer(question.getId(), answer);
                    questionsAttempted.append(question.getQuestionText()).append("\n");
                    answersGiven.append(answer).append("\n");

                }
                Instant end = Instant.now();
                Duration timeTaken = Duration.between(start, end);
                int score = currentChallenge.calculateScore();
                out.println("Challenge complete! Your score: " + score);
                try (Connection connection = Database.getConnection()) {
                    String insertAttemptQuery = "INSERT INTO attempts (username, challenge_id, score, questions_attempted) VALUES (?, ?, ?, ?)";

                    PreparedStatement insertStatement = connection.prepareStatement(insertAttemptQuery);
                    insertStatement.setString(1, loggedInPupil.username);
                    insertStatement.setString(2, challengeId);
                    insertStatement.setInt(3, score);
                    insertStatement.setString(4, questionsAttempted.toString());
                    insertStatement.executeUpdate();

                    try {
                        // Create PDF with attempt details
                        String pdfFilePath = createPdf(loggedInPupil.username, score, questionsAttempted.toString(), answersGiven.toString(), timeTaken.toString());

                        // Send email with the PDF attachment
                        String recipientEmail = loggedInPupil.email;
                        String subject = "Challenge Attempt Details";
                        String body = "Dear " + loggedInPupil.username + ",\n\nThank you for using the Mathematics Challenge Platform. Please find attached the details of your recent challenge attempt.";

                        EmailUtility.sendEmailWithAttachment(recipientEmail, subject, body, pdfFilePath);
                        // Optionally, delete the PDF file after sending
                        // File pdfFile = new File(pdfFilePath);
                        // pdfFile.delete();

                        System.out.println("Email sent successfully!");
                    } catch (IOException e) {
                        e.printStackTrace();
                        out.println("Error creating or accessing PDF file.");
                    } catch (MessagingException e) {
                        e.printStackTrace();
                        out.println("Error sending email with challenge details.");
                    } catch (Exception e) {
                        e.printStackTrace();
                        out.println("Unknown error occurred.");
                    }

                } catch (SQLException e) {
                    e.printStackTrace();
                    out.println("Error processing the challenge attempt.");
                }

            } else {
                out.println("Challenge not found");
            }
        }

        private List<Question> getRandomQuestions(String challengeId) {
            List<Question> questions = new ArrayList<>();
            String query = "SELECT * FROM questions WHERE challenge_id = ? ORDER BY RAND() LIMIT 10";
            try (Connection connection = Database.getConnection();
                 PreparedStatement preparedStatement = connection.prepareStatement(query)) {
                preparedStatement.setString(1, challengeId);
                ResultSet resultSet = preparedStatement.executeQuery();

                while (resultSet.next()) {
                    String id = resultSet.getString("id");
                    String questionText = resultSet.getString("question");
                    String correctAnswer = resultSet.getString("answer");
                    Question question = new Question(id, questionText, correctAnswer);
                    questions.add(question);
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
            return questions;
        }

        private void confirmParticipant(String[] parts) {
            if (parts.length < 3) {
                out.println("Incomplete Command request");
                return;
            }
            String Username = parts[1];
            boolean confirmed = "yes".equalsIgnoreCase(parts[2]);
            Iterator<Participant> iterator = server.getWaitingParticipants().iterator();
            while (iterator.hasNext()) {
                Participant participant = iterator.next();
                if (participant.username.equals(Username)) {
                    iterator.remove();
                    if (confirmed) {
                        server.addConfirmedParticipant(participant);
                        deleteFromTempFile(participant.username);
                        out.println("Participant confirmed");
                        try {
                            String query = "INSERT INTO participants(username,firstname,lastname,email,date_of_birth,registration_number,password) VALUES(?,?,?,?,?,?,?)";
                            Connection connection = Database.getConnection();
                            PreparedStatement preparedStatement = connection.prepareStatement(query);
                            preparedStatement.setString(1, participant.username);
                            preparedStatement.setString(2, participant.firstname);
                            preparedStatement.setString(3, participant.lastname);
                            preparedStatement.setString(4, participant.email);
                            preparedStatement.setString(5, participant.date_of_birth);
                            preparedStatement.setString(6, participant.registration_number);
                            preparedStatement.setString(7, participant.password);
                            preparedStatement.executeUpdate();
                            out.println("Participant confirmed");

                            EmailUtility.sendEmail(participant.email, "Registration Confirmed", "Dear " + participant.firstname + ", your registration has been confirmed.");
                        } catch (SQLException | MessagingException e) {
                            e.printStackTrace();
                            out.println("Error saving into database: " + e.getMessage());
                        }
                    } else {

                        // Add participant to rejected participants and insert into database
                        try {
                            String query = "INSERT INTO rejected_participants(username,registration_number) VALUES(?,?)";
                            Connection connection = Database.getConnection();
                            PreparedStatement preparedStatement = connection.prepareStatement(query);
                            preparedStatement.setString(1, participant.username);
                            preparedStatement.setString(2, participant.registration_number);
                            preparedStatement.executeUpdate();
                            out.println("Participant Rejected");
                            EmailUtility.sendEmail(participant.email, "Registration Rejected", "Dear " + participant.firstname + ", your registration has been rejected.");
                        } catch (SQLException | MessagingException e) {
                            e.printStackTrace();
                            out.println("Error saving into database");
                        }
                    }
                    return;
                }
            }
            out.println("participant not found");
        }

        private void deleteFromTempFile(String Username) {
            File tempFile = new File("temp-registrations.txt");
            File newFile = new File("temp-registrations.txt");
            try {
                BufferedReader reader = new BufferedReader(new FileReader(tempFile));
                BufferedWriter writer = new BufferedWriter(new FileWriter(newFile));
                String currentLine;
                while ((currentLine = reader.readLine()) != null) {
                    String trimmedLine = currentLine.trim();
                    if (!trimmedLine.startsWith(Username)) {
                        writer.write(currentLine + System.getProperty("line.separator"));
                    }
                }
            } catch (IOException e) {
                e.printStackTrace();
            }
            if (!tempFile.delete()) {
                System.out.println("Could not delete file");
                return;
            }
            if (!newFile.renameTo(tempFile)) {
                System.out.println("Rename file failed");
            }
        }

        private void viewParticipants() {
            List<Participant> waitingParticipants = server.getWaitingParticipants();
            if (waitingParticipants.isEmpty()) {
                out.println("No pending participants");
            } else {
                out.println("Waiting Participants:");
                for (Participant p : waitingParticipants) {
                    out.println(p.getUsername() + " - " + p.getFirstname() + " "  + " - " + p.getRegistration_number());
                }
            }
            out.flush();
        }
    }
    //nested class for question details
    static class Question{
        private String id;
        private String questionText;
        private String correctAnswer;
        public Question(String id, String questionText, String correctAnswer){
            this.id = id;
            this.questionText =questionText;
            this.correctAnswer = correctAnswer;
        }
        public String getId(){
            return id;
        }
        public  String getQuestionText(){
            return questionText;
        }
        public String getCorrectAnswer(){
            return correctAnswer;
        }
    }
    static class ChallengeAttempt{
        private List<Question> questions;
        private Map<String, String> answers;
        private long startTime;
        private long endTime;
        private int score;
        public ChallengeAttempt(List<Question> questions){
            this.questions = questions;
            this.answers = new HashMap<>();
            this.startTime = System.currentTimeMillis();
            this.endTime = startTime +(30*60*1000);
            this.score = 0;
        }
        public List<Question>getQuestions(){
            return questions;
        }
        public void setAnswer(String questionId,String answer){
            answers.put(questionId,answer);
        }
        public String getAnswer(String questionId){
            return answers.get(questionId);
        }
        public int calculateScore() {
            for (Question question : questions) {
                String givenAnswer = answers.get(question.getId());
                if (givenAnswer != null) {
                    if (givenAnswer.equalsIgnoreCase(question.getCorrectAnswer())) {
                        score += 5;
                    } else if (!"not sure".equalsIgnoreCase(givenAnswer)) {
                        score -= 3;
                    }
                }
            }
            return score;
        }
        public boolean isTimeUp() {
            return System.currentTimeMillis() > endTime;
        }
    }
    private static String createPdf(String username, int score, String questionsAttempted, String answersGiven, String timeTaken) throws IOException {
        String pdfFilePath = "C:\\Users\\hp\\Documents\\Challenge PDF Files" + username + "_challenge_details.pdf";

        Document document = new Document();
        try {
            PdfWriter.getInstance(document, new FileOutputStream(pdfFilePath));
            document.open();
            document.add(new Paragraph("Challenge Attempt Details"));
            document.add(new Paragraph("Username: " + username));
            document.add(new Paragraph("Score: " + score));
            document.add(new Paragraph("Time Taken: " + timeTaken));
            document.add(new Paragraph("Questions Attempted:\n" + questionsAttempted));
            document.add(new Paragraph("Answers Given:\n" + answersGiven));
        } catch (DocumentException e) {
            e.printStackTrace();
        } finally {
            document.close();
        }

        return pdfFilePath;
    }
}
