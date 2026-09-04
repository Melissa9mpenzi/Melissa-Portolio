"use client";

import { FaGithub, FaLinkedin, FaEnvelope, FaDownload } from "react-icons/fa";

const Hero = () => {
  return (
    <section id="home" className="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 pt-16">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div className="text-center">
          {/* Profile Image Placeholder */}
          <div className="mb-8 flex justify-center">
            <div className="w-40 h-40 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white text-6xl font-bold shadow-2xl">
              ML
            </div>
          </div>

          {/* Main Heading */}
          <h1 className="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
            <span className="text-gray-900 dark:text-white">Hi, I&apos;m </span>
            <span className="bg-gradient-to-r from-primary via-secondary to-accent bg-clip-text text-transparent">
              Melissa Sharon Lokoroma
            </span>
          </h1>

          {/* Subheading */}
          <p className="text-2xl md:text-3xl text-gray-700 dark:text-gray-300 mb-4 animate-slide-up">
            Web Solutions Developer | Software Engineer
          </p>

          <p className="text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto mb-8 animate-slide-up">
            Building modern web applications with React, Next.js, Python, and WordPress.
            Transforming ideas into functional, beautiful digital experiences.
          </p>

          {/* CTA Buttons */}
          <div className="flex flex-col sm:flex-row gap-4 justify-center mb-12 animate-slide-up">
            <a
              href="#contact"
              className="px-8 py-4 bg-gradient-to-r from-primary to-secondary text-white rounded-full font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-300"
            >
              Get In Touch
            </a>
            <a
              href="/Melissa_Sharon_Lokoroma_CV.pdf"
              download
              className="px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-full font-semibold border-2 border-primary hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2"
            >
              <FaDownload />
              Download CV
            </a>
          </div>

          {/* Social Links */}
          <div className="flex justify-center space-x-6 animate-slide-up">
            <a
              href="https://github.com/Melissa9mpenzi"
              target="_blank"
              rel="noopener noreferrer"
              className="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-all duration-300 transform hover:scale-110"
              aria-label="GitHub"
            >
              <FaGithub size={32} />
            </a>
            <a
              href="https://www.linkedin.com/in/melissa-sharon-lokoroma-aa8681316/"
              target="_blank"
              rel="noopener noreferrer"
              className="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-all duration-300 transform hover:scale-110"
              aria-label="LinkedIn"
            >
              <FaLinkedin size={32} />
            </a>
            <a
              href="mailto:melissampenzi@gmail.com"
              className="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-all duration-300 transform hover:scale-110"
              aria-label="Email"
            >
              <FaEnvelope size={32} />
            </a>
          </div>
        </div>
      </div>

      {/* Scroll Indicator */}
      <div className="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div className="w-6 h-10 border-2 border-gray-400 dark:border-gray-600 rounded-full flex items-start justify-center p-2">
          <div className="w-1 h-3 bg-gray-400 dark:bg-gray-600 rounded-full animate-pulse"></div>
        </div>
      </div>
    </section>
  );
};

export default Hero;
