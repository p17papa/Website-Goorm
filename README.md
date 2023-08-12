# Website built on Goorm (Cloud IDE Service)
This is an academic project that had some tasks to accomplice.

# Project Goal
The goal of this project is to create an online community (essentially a dynamic website) for posting, answering, and searching technical questions. This will be achieved by leveraging internet technologies, including HTML, CSS, JavaScript, PHP, XML, and REST API, along with a MySQL relational database.

## Project Scope
The task is to implement a website where users can visit to post questions on technical topics, search for existing answers, and provide answers to questions if they know the solution.

## Specific Requirements

1. **Create two static HTML pages:**
   a) A page explaining the purpose of your website, how users can register, and why.
   b) A concise basic help page.

2. **Implement CSS and JavaScript:**
   - Sections should appear/disappear as accordion panels on user click.
   - Support light and dark themes that users can switch with a click. User preferences should be saved using cookies and applied automatically on subsequent page loads.

3. **Create a PHP page for user registration:**
   - Store user information in a MySQL database.
   - Required user data: name, surname, username, password, email, simplepush.io key1 (for sending push notifications to mobile devices, optional).

4. **Create PHP pages for user profile management:**
   - Users can delete their profile, but the record remains in the database for associating with user posts.

5. **Create PHP pages for managing questions and answers:**
   - Users can submit new questions and answers.
   - Display all questions in a chronological list.
   - Show details of a question with its answers.

6. **Create a PHP page to search questions and answers based on various criteria:**
   - Text in titles or content.
   - Date range of submission.
   - User's name, surname, or email.

7. **Create a PHP page to export questions and answers as open data in XML format.** The export should not include full user details, only a unique identifier.

8. **Use the SimplePush.io service for sending push notifications to users who have registered their SimplePush.io key:**
   a) Notify users when they post a question.
   b) Notify users when another user replies to their question.

9. **Implement user authentication:**
   - Segregate pages into two categories: accessible freely and accessible after authentication.
   - Redirect unauthenticated users to the authentication page.

10. **Include a navigation menu at the top of all pages.** Certain options should be hidden when the user is not authenticated.
