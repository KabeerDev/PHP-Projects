<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
  <title>Portfolio</title>
</head>

<body>
  portfolio
  <header class="header">
    <a href="/index.html" class="logo">Portfolio</a>
    <nav class="nav">
      <a href="#home" style="--i: 1" class="active">Home</a>
      <a href="#about" style="--i: 2">About</a>
      <a href="#skills" style="--i: 3">Skill</a>
      <a href="#portfolio" style="--i: 4">Portfolio</a>
      <a href="#contact" style="--i: 5">Contact</a>
    </nav>
  </header>
  <section class="home" id="home">
    <div class="home-content">
      <h3>Hello, It's Me</h3>
      <h1>Kabir Ahmad</h1>
      <h3>And i'm a <span class="text"></span></h3>
      <p>I'm a Full Stack developer</p>
      <div class="home-sci">
        <a href="https://github.com/Kabir-Ahmad" style="--i: 6" target="_blank"><i class="fa-brands fa-github"></i></a>
      </div>
      <div class="btn-box">
        <a href="#about">More About Me</a>
      </div>
    </div>
    <div class="img">
      <img src="img/pic1.JPG" alt="my image" />
    </div>
  </section>
  <section class="about" id="about">
    <div class="about-img">
      <img src="img/pic1.JPG" alt="my image" />
    </div>
    <div class="about-text">
      <h2>About <span>Me</span></h2>
      <h4>Full Stack Developer!</h4>
      <p>
        I am a seasoned Full Stack Developer with a passion for crafting
        robust and innovative web solutions. Proficient in HTML, CSS, and
        JavaScript, I specialize in creating visually appealing and responsive
        user interfaces. My expertise extends to Bootstrap, ensuring seamless
        integration of design elements for a polished user experience. In the
        backend, I excel in PHP and MySQL, employing these technologies to
        build dynamic and efficient databases and server-side logic.
        Additionally, my skills encompass Laravel, allowing me to develop
        scalable and feature-rich web applications. With a keen eye for detail
        and a commitment to staying abreast of the latest industry trends, I
        bring a holistic approach to web development, ensuring both frontend
        and backend components harmonize seamlessly to deliver top-notch
        solutions.
      </p>
      <a href="" class="btn-box">More About Me</a>
    </div>
  </section>
  <section class="services" id="services">
    <div class="container">
      <h1 class="sub-title">My <span>Services</span></h1>
      <div class="services-list">
        <div>
          <i class="fa-solid fa-code" style="color: #00eeff"></i>
          <h2>UI/UX Design</h2>
          <p>
            User-centric design principles prioritize enhancing the overall
            user experience. Intuitive navigation, aesthetically pleasing
            interfaces, and seamless interactions contribute to a compelling
            user journey. Iterative prototyping and user feedback loops guide
            the evolution of a design, ensuring it aligns with both user needs
            and business goals.
          </p>
          <a href="" class="read">Learn More</a>
        </div>
        <div>
          <i class="fa-solid fa-crop-simple" style="color: #00eeff"></i>
          <h2>Frontend</h2>
          <p>
            Frontend using HTML, CSS, Bootstrap, and JS design integrates
            seamlessly to create a visually appealing and user-friendly
            interface. Crafting an interactive and responsive layout, it
            combines the power of these technologies to deliver an engaging
            digital experience for users. Leveraging the strengths of HTML for
            structure, CSS for styling, Bootstrap for a consistent framework,
            and JavaScript for dynamic functionality, this frontend design
            ensures a smooth and aesthetically pleasing user interaction.
          </p>
          <a href="" class="read">Learn More</a>
        </div>
        <div>
          <i class="fa-brands fa-apple" style="color: #00eeff"></i>
          <h2>Backend</h2>
          <p>
            Backend using PHP and Laravel with development server, database
            integration, and efficient coding practices. Handling user
            authentication, data storage, and seamless communication between
            components. Streamlining processes for optimal performance and
            scalability.
          </p>
          <a href="" class="read">Learn More</a>
        </div>
      </div>
    </div>
  </section>
  <h1 class="sub-title">My <span>Skills</span></h1>
  <section>
    <div class="container1" id="skills">
      <h1 class="heading1">Technical Skills</h1>
      <div class="technical-bars">
        <div class="bar">
          <i style="color: #c95d2e" class="fa-brands fa-html5"></i>
          <div class="info">
            <span>HTML</span>
            <div class="progress-line html">
              <span></span>
            </div>
          </div>
        </div>
        <div class="bar">
          <i style="color: #147bbc" class="fa-brands fa-css3"></i>
          <div class="info">
            <span>CSS</span>
            <div class="progress-line css">
              <span></span>
            </div>
          </div>
        </div>
        <div class="bar">
          <i style="color: #b0bc1e" class="fa-brands fa-js"></i>
          <div class="info">
            <span>Js</span>
            <div class="progress-line js">
              <span></span>
            </div>
          </div>
        </div>
        <div class="bar">
          <i style="color: #4f5b93" class="fa-brands fa-php"></i>
          <div class="info">
            <span>PHP</span>
            <div class="progress-line php">
              <span></span>
            </div>
          </div>
        </div>
        <div class="bar">
          <i style="color: #dbdbdb" class="fa-solid fa-database"></i>
          <div class="info">
            <span>MySql</span>
            <div class="progress-line mysql">
              <span></span>
            </div>
          </div>
        </div>
        <div class="bar">
          <i style="color: #7410f0" class="fa-brands fa-bootstrap"></i>
          <div class="info">
            <span>Bootstrap</span>
            <div class="progress-line bootstrap">
              <span></span>
            </div>
          </div>
        </div>
        <div class="bar">
          <i style="color: #f7382f" class="fa-brands fa-laravel"></i>
          <div class="info">
            <span>Laravel</span>
            <div class="progress-line laravel">
              <span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container1">
      <h1 class="heading1">Professional Skills</h1>
      <div class="radial-bars">
        <div class="radial-bar">
          <svg x="0px" y="0px" viewBox="0 0 200 200">
            <circle class="progress-bar" cx="100" cy="100" r="80"></circle>
            <circle class="path path-1" cx="100" cy="100" r="80"></circle>
          </svg>
          <div class="percentage">90%</div>
          <div class="text">creativity</div>
        </div>
        <div class="radial-bar">
          <svg x="0px" y="0px" viewBox="0 0 200 200">
            <circle class="progress-bar" cx="100" cy="100" r="80"></circle>
            <circle class="path path-2" cx="100" cy="100" r="80"></circle>
          </svg>
          <div class="percentage">65%</div>
          <div class="text">communication</div>
        </div>
        <div class="radial-bar">
          <svg x="0px" y="0px" viewBox="0 0 200 200">
            <circle class="progress-bar" cx="100" cy="100" r="80"></circle>
            <circle class="path path-3" cx="100" cy="100" r="80"></circle>
          </svg>
          <div class="percentage">75%</div>
          <div class="text">Problem Solving</div>
        </div>
        <div class="radial-bar">
          <svg x="0px" y="0px" viewBox="0 0 200 200">
            <circle class="progress-bar" cx="100" cy="100" r="80"></circle>
            <circle class="path path-4" cx="100" cy="100" r="80"></circle>
          </svg>
          <div class="percentage">80%</div>
          <div class="text">Teamwork</div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div id="portfolio" class="project">
      <div class="main-text" id="project">
        <h2>Latest <span>Project</span></h2>
        <div class="portfolio-content">
          <div class="row">
            <img src="img/project1.png" alt="image for project" />
            <div class="layer">
              <h5>Spotify Clone</h5>
              <p>
                Spotify Clone is a comprehensive music streaming platform that
                mirrors the functionalities of the popular Spotify
                application. As the primary developer behind this project, I
                undertook the challenge of recreating the seamless and
                immersive experience that Spotify offers while incorporating
                some unique features.
              </p>
              <a href="#"><i class="fa-solid fa-arrow-up-right-from-square" style="color: aliceblue"></i></a>
            </div>
          </div>
          <div class="row">
            <img src="img/project2.png" alt="image for project" />
            <div class="layer">
              <h5>Forum Website</h5>
              <p>
                CodeConnect Forum is a dynamic and interactive platform
                designed for coding enthusiasts to connect, collaborate, and
                elevate their programming skills. As the lead developer on
                this project, I spearheaded the creation of a vibrant online
                space where coders from all levels of expertise can engage in
                meaningful discussions, share insights, and seek assistance on
                various programming topics.
              </p>
              <a href="#"><i class="fa-solid fa-arrow-up-right-from-square" style="color: aliceblue"></i></a>
            </div>
          </div>
          <div class="row">
            <img src="img/project3.png" alt="image for project" />
            <div class="layer">
              <h5>Weather App</h5>
              <p>
                WeatherWave is a cutting-edge weather application designed to
                provide users with real-time weather information in a visually
                appealing and user-friendly format. As the sole developer
                behind this project, I aimed to create an intuitive and
                feature-rich platform that offers more than just basic weather
                updates.
              </p>
              <a href="#"><i class="fa-solid fa-arrow-up-right-from-square" style="color: aliceblue"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="contact" id="contact">
    <div class="contact-text">
      <h2>Contact <span>Me</span></h2>
      <h4>Let's Work Together</h4>
      <p>
        Thank you for reaching out to us! We appreciate your interest in
        collaborating. Please fill out the form below with your details, and
        we'll get back to you as soon as possible. Let's work together to
        create something amazing.
      </p>
      <div class="contact-list">
        <li><i class="fa-solid fa-paper-plane"></i>contact@gmail.com</li>
        <li><i class="fa-solid fa-phone"></i>0123456789</li>
      </div>
      <div class="contact-icons">
        <a href="https://github.com/Kabir-Ahmad" target="_blank"><i class="fa-brands fa-github"></i></a>
      </div>
    </div>
    <div class="contact-form">
      <form class="msgForm" action="#">
        <input type="text" name="name" placeholder="Enter Your Name" />
        <input type="text" name="email" placeholder="Enter Your Email" />
        <input type="" name="subject" placeholder="Enter Your Subject" />
        <textarea name="msg" id="" cols="40" rows="10" placeholder="Enter Your Message"></textarea>
        <input type="submit" value="Submit" class="send" />
        <span>Sending Your Message ...</span>
      </form>
    </div>
  </section>
  <div class="last-text">
    <p>Developed With Love By Kabir Ahmad &copy; 2023</p>
  </div>
  <a href="#home" class="top"><i class="fa-solid fa-angle-up"></i></a>
  <script src="js/script.js"></script>
</body>

</html>