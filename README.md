# Gemba Digital

<!--
*** README.md generated for ardfar/gemba-digital
-->

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]

<br />
<div align="center">
  <a href="https://github.com/ardfar/gemba-digital">
    <!-- You can add your logo here -->
    <img src="https://genba.aradenta.com/assets/images/logo-dark.png" alt="Logo">
  </a>

  <h1 align="center">Gemba Digital</h1>

  <p align="center">
    A web application for conducting Digital Gemba Walks to drive continuous improvement.
    <br />
    <a href="https://github.com/ardfar/gemba-digital"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://genba.aradenta.com">View Demo</a>
    ·
    <a href="https://github.com/ardfar/gemba-digital/issues">Report Bug</a>
    ·
    <a href="https://github.com/ardfar/gemba-digital/issues">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#environment-setup">Environment Setup</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

---

## About The Project

[![Product Screenshot](https://genba.aradenta.com/assets/images/app-screenshot.png)](https://github.com/ardfar/gemba-digital)


`Gemba Digital` is a tool designed to modernize the practice of Gemba Walks. Traditionally, a Gemba Walk involves managers going to the "real place" where work happens to observe, engage, and identify opportunities for improvement. This project digitizes that process, allowing for structured data collection, analysis, and follow-up on findings to foster a culture of continuous improvement.

This platform helps teams to:
* Systematically record observations and findings during a walk.
* Assign and track corrective and preventive actions.
* Analyze trends and patterns from the collected data.
* Collaborate more effectively on improvement initiatives.

### Built With

This project is built with the following technologies:

* [![Laravel][Laravel.com]][Laravel-url]
* [![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
* [![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
* [![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)

---

## Getting Started

To get a local copy up and running, follow these steps.

### Prerequisites

Make sure you have the following software installed on your machine.
* PHP (>= 8.1)
* Composer
* Node.js & npm
* A database server (e.g., MySQL)

### Environment Setup

1.  **Copy .env.example**
    ```sh
    cp .env.example .env
    ```
2.  **Set Your Locale**
    * useful to match local timezone and date format
    ```env
    APP_LOCALE=id
    APP_FALLBACK_LOCALE=id
    APP_FAKER_LOCALE=id_ID
    ```
3.  **Set Your Database Connection**
    * You might need to create the database first
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database
    DB_USERNAME=username
    DB_PASSWORD=password
    ```
4.  **Set Your SMTP Connection**
    * This configuration is required to allow system send email of password reset request, You might need to use 3rd party STMP provider or you can deploy on your own server.
    ```env
    MAIL_MAILER=smtp
    MAIL_SCHEME=null
    MAIL_HOST=mail.example.com
    MAIL_PORT=587
    MAIL_ENCRYPTION=tls
    MAIL_USERNAME=username@example.com
    MAIL_PASSWORD=password
    MAIL_FROM_ADDRESS=username@example.com
    MAIL_FROM_NAME="YOUR APP NAME"
    ```
5.  **Customize Sweetalert Delete Message**
    * This configuration is used to customize parameters of sweetalert delete pop-up, please refers to it's specific documentation ([See The Documentation](https://realrashid.github.io/sweet-alert/environment)).
    ```env
    SWEET_ALERT_CONFIRM_DELETE_CONFIRM_BUTTON_TEXT='Yes, Delete'
    SWEET_ALERT_CONFIRM_DELETE_CANCEL_BUTTON_TEXT='No, Return'
    SWEET_ALERT_CONFIRM_DELETE_SHOW_CANCEL_BUTTON=true
    SWEET_ALERT_CONFIRM_DELETE_SHOW_CLOSE_BUTTON=false
    SWEET_ALERT_CONFIRM_DELETE_ICON='warning'
    SWEET_ALERT_CONFIRM_DELETE_SHOW_LOADER_ON_CONFIRM=true
    ```
6.  **Connect Application to Gemba AI Service**
    * This configuration is required to connect AI services in this application.
    ```env
    GENBA_AI_API_ADDRESS=http://api.example.com
    GENBA_AI_API_KEY=YOUR_API_KEY
    ```

### Installation

1.  **Clone the repo**
    ```sh
    git clone https://github.com/ardfar/gemba-digital.git
    cd gemba-digital
    ```
2.  **Install PHP dependencies**
    ```sh
    composer install
    ```
3.  **Install NPM packages**
    ```sh
    npm install
    ```    
4.  **Configure your application environment**
    * Please refers to the previous parts

5.  **Create your application key**
    ```sh
    php artisan key:generate
    ``` 
6.  **Compile front-end assets**
    ```sh
    npm run dev
    ```
7.  **Create storage link for your application**
    * This setting is required. Otherwise, Your files uploaded to the application won't show up.
    ```sh
    php artisan storage:link
    ``` 
8.  **Run the development server**
    ```sh
    php artisan serve
    ```
    Your application will be available at `http://127.0.0.1:8000`.

---

## Updating The Application
To update the application, follow these steps:

1.  **Pull the latest update from github**
    * Checkout to branch `main` first then pull the latest one.
    ```sh
    git checkout main
    git pull
    ```
2.  **Install required library**
    ```sh
    composer install
    ```
3.  **Re-link your Application storage link**
    ```sh
    rm public/storage/
    php artisan storage:link
    ```


---

## Usage

Once the application is running, you can log in with the default user created by the seeder and start exploring the features.

* Create new Gemba Walk schedules.
* Record findings and classify them.
* Generate corrective and preventive action suggestions.

_We recommend adding screenshots or GIFs here to demonstrate the application's features._

---

## Roadmap

See the [open issues](https://github.com/ardfar/gemba-digital/issues) for a full list of proposed features (and known issues).

---

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

---

## License

This program only for testing - for commercial use, Please contact me

---

## Contact

Farras Arrafi - [@aradenta_fareast](https://instagram.com/aradenta_fareast09) - me@aradenta.com

Project Link: [https://github.com/ardfar/gemba-digital](https://github.com/ardfar/gemba-digital)


<!-- MARKDOWN LINKS & IMAGES -->
[contributors-shield]: https://img.shields.io/github/contributors/ardfar/gemba-digital.svg?style=for-the-badge
[contributors-url]: https://github.com/ardfar/gemba-digital/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/ardfar/gemba-digital.svg?style=for-the-badge
[forks-url]: https://github.com/ardfar/gemba-digital/network/members
[stars-shield]: https://img.shields.io/github/stars/ardfar/gemba-digital.svg?style=for-the-badge
[stars-url]: https://github.com/ardfar/gemba-digital/stargazers
[issues-shield]: https://img.shields.io/github/issues/ardfar/gemba-digital.svg?style=for-the-badge
[issues-url]: https://github.com/ardfar/gemba-digital/issues
[license-shield]: https://img.shields.io/github/license/ardfar/gemba-digital.svg?style=for-the-badge
[license-url]: https://github.com/ardfar/gemba-digital/blob/main/LICENSE
[product-screenshot]: https://placehold.co/600x400?text=Your+App+Screenshot
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
