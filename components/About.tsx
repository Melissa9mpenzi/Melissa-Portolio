const About = () => {
  return (
    <section id="about" className="py-20 bg-white dark:bg-gray-900">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            About <span className="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Me</span>
          </h2>
          <div className="w-20 h-1 bg-gradient-to-r from-primary to-secondary mx-auto"></div>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          {/* Text Content */}
          <div>
            <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-4">
              Web Solutions Developer & Software Engineer
            </h3>
            <p className="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
              I am a Web Developer with over <span className="font-semibold text-primary">4 years of experience</span> building, 
              customizing, deploying, and maintaining modern websites and web applications. My experience spans across 
              WordPress development, frontend technologies, responsive web design, website optimization, hosting management, 
              and UI/UX implementation.
            </p>
            <p className="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
              I enjoy transforming ideas into functional digital products that are visually appealing, user-friendly, and 
              aligned with business goals. Throughout my career, I have worked closely with clients, project teams, and 
              stakeholders to deliver websites that perform reliably across devices and browsers while maintaining high 
              standards of usability and performance.
            </p>
            <p className="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
              Currently, I work at <span className="font-semibold text-secondary">Lwegatech</span> as a Web Solutions Developer, 
              where I design, develop, and maintain responsive web platforms using PHP, React, WordPress, and Python.
            </p>

            {/* Stats */}
            <div className="grid grid-cols-2 sm:grid-cols-3 gap-6 mt-8">
              <div className="text-center p-4 bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-800 dark:to-gray-700 rounded-lg">
                <div className="text-3xl font-bold text-primary mb-1">4+</div>
                <div className="text-sm text-gray-600 dark:text-gray-300">Years Experience</div>
              </div>
              <div className="text-center p-4 bg-gradient-to-br from-purple-50 to-pink-50 dark:from-gray-800 dark:to-gray-700 rounded-lg">
                <div className="text-3xl font-bold text-secondary mb-1">15+</div>
                <div className="text-sm text-gray-600 dark:text-gray-300">Projects Delivered</div>
              </div>
              <div className="text-center p-4 bg-gradient-to-br from-pink-50 to-blue-50 dark:from-gray-800 dark:to-gray-700 rounded-lg">
                <div className="text-3xl font-bold text-accent mb-1">680+</div>
                <div className="text-sm text-gray-600 dark:text-gray-300">Development Hours</div>
              </div>
            </div>
          </div>

          {/* Image/Visual Element */}
          <div className="relative">
            <div className="bg-gradient-to-br from-primary via-secondary to-accent rounded-2xl p-8 shadow-2xl transform hover:scale-105 transition-transform duration-300">
              <div className="bg-white dark:bg-gray-800 rounded-xl p-6">
                <h4 className="text-xl font-bold text-gray-900 dark:text-white mb-4">What I Bring</h4>
                <ul className="space-y-3">
                  <li className="flex items-start">
                    <span className="text-primary mr-2">✓</span>
                    <span className="text-gray-700 dark:text-gray-300">Modern web development with React, Next.js & TypeScript</span>
                  </li>
                  <li className="flex items-start">
                    <span className="text-primary mr-2">✓</span>
                    <span className="text-gray-700 dark:text-gray-300">WordPress customization & theme development</span>
                  </li>
                  <li className="flex items-start">
                    <span className="text-primary mr-2">✓</span>
                    <span className="text-gray-700 dark:text-gray-300">Backend development with Python & Django</span>
                  </li>
                  <li className="flex items-start">
                    <span className="text-primary mr-2">✓</span>
                    <span className="text-gray-700 dark:text-gray-300">UI/UX design & implementation with Figma</span>
                  </li>
                  <li className="flex items-start">
                    <span className="text-primary mr-2">✓</span>
                    <span className="text-gray-700 dark:text-gray-300">Responsive, mobile-first design principles</span>
                  </li>
                  <li className="flex items-start">
                    <span className="text-primary mr-2">✓</span>
                    <span className="text-gray-700 dark:text-gray-300">Hosting, deployment & domain management</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default About;
