import { FaGithub, FaLinkedin, FaEnvelope, FaPhone } from "react-icons/fa";

const Footer = () => {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="bg-gray-900 text-white py-12">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {/* About Section */}
          <div>
            <h3 className="text-xl font-bold mb-4 bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
              Melissa Sharon Lokoroma
            </h3>
            <p className="text-gray-400 text-sm">
              Web Solutions Developer & Software Engineer specializing in modern web technologies and creating impactful digital solutions.
            </p>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="text-xl font-bold mb-4">Quick Links</h3>
            <ul className="space-y-2">
              <li>
                <a href="#about" className="text-gray-400 hover:text-primary transition-colors">
                  About
                </a>
              </li>
              <li>
                <a href="#experience" className="text-gray-400 hover:text-primary transition-colors">
                  Experience
                </a>
              </li>
              <li>
                <a href="#projects" className="text-gray-400 hover:text-primary transition-colors">
                  Projects
                </a>
              </li>
              <li>
                <a href="#contact" className="text-gray-400 hover:text-primary transition-colors">
                  Contact
                </a>
              </li>
            </ul>
          </div>

          {/* Contact Info */}
          <div>
            <h3 className="text-xl font-bold mb-4">Get In Touch</h3>
            <ul className="space-y-3">
              <li className="flex items-center space-x-3">
                <FaEnvelope className="text-primary" />
                <a
                  href="mailto:melissampenzi@gmail.com"
                  className="text-gray-400 hover:text-primary transition-colors text-sm"
                >
                  melissampenzi@gmail.com
                </a>
              </li>
              <li className="flex items-center space-x-3">
                <FaPhone className="text-primary" />
                <span className="text-gray-400 text-sm">+256 765 022 499</span>
              </li>
              <li className="flex items-center space-x-4 mt-4">
                <a
                  href="https://github.com/Melissa9mpenzi"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-gray-400 hover:text-primary transition-colors"
                  aria-label="GitHub"
                >
                  <FaGithub size={24} />
                </a>
                <a
                  href="https://www.linkedin.com/in/melissa-sharon-lokoroma-aa8681316/"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-gray-400 hover:text-primary transition-colors"
                  aria-label="LinkedIn"
                >
                  <FaLinkedin size={24} />
                </a>
              </li>
            </ul>
          </div>
        </div>

        {/* Copyright */}
        <div className="mt-12 pt-8 border-t border-gray-800 text-center">
          <p className="text-gray-400 text-sm">
            © {currentYear} Melissa Sharon Lokoroma. All rights reserved.
          </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
