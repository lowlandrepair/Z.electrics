# IT-Company-Website

## Note

**Please be aware that the PHP Mailer feature is not functional on the deployed website. To utilize it, you'll need to download the entire project and run it locally on your computer using XAMPP or WAMP.**  
Additionally, you'll have to set up the sender's credentials in the `mailing/mailingvariables.php` file. In the `contactme.php` and `careers.php` files, you should specify the receiver's email address. Don't forget to provide the path to the `tmp-uploads` folder in `careers.php` file to store uploaded files.

## Installation

1. Download or clone the repository to your local machine.  
2. Install XAMPP or WAMP server on your computer if you haven't already.  
3. Place the project folder inside the `htdocs` directory of XAMPP or the `www` directory of WAMP.  
4. Start Apache and MySQL services from the XAMPP/WAMP control panel.  
5. Open your browser and navigate to `http://localhost/agjii` (or the folder name you used).  
6. Make sure to configure the mailing variables as described above to enable email functionality.

## Usage

- Navigate through the website modules such as About, Services, Portfolio, Team, Career, Contact, and FAQ.  
- Use the Contact and Career forms to send inquiries or job applications.  
- Emails will be sent to the configured company email address upon form submission.

## Project Structure

```
/agjii
│
├── index.html               # Main landing page
├── careers.html             # Careers page
├── css/                    # Stylesheets
│   ├── style.css
│   └── careers.css
├── js/                     # JavaScript files
│   └── main.js
├── images/                 # Image assets
├── lib/                    # Third-party libraries (Bootstrap, jQuery, etc.)
├── mailing/                # PHP mailing scripts and source files
│   ├── career_mail.php
│   ├── contact_mail.php
│   └── src/                # PHPMailer library source files
└── README.md               # Project documentation
```



