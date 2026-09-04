"use client";

import { FaExternalLinkAlt, FaGithub, FaGooglePlay, FaApple } from "react-icons/fa";

const Projects = () => {
  const featuredProjects = [
    {
      title: "Jambo App",
      category: "Mobile Application",
      description: "A cross-platform food delivery solution connecting customers, restaurants, and delivery riders. Features real-time order tracking and delivery management workflows. Available on Google Play Store and Apple App Store.",
      technologies: ["Flutter", "REST API", "Mobile UI/UX", "iOS", "Android"],
      highlights: [
        "Designed complete wireframes and user journey flows",
        "Developed full frontend architecture for customer and courier apps",
        "Implemented reusable UI components and navigation systems",
        "Integrated with backend REST APIs for real-time functionality",
      ],
      link: "https://jamboapp.io/",
      appStores: {
        playStore: "https://play.google.com/store/apps/details?id=com.jamboapp.customer",
        appStore: "https://apps.apple.com/app/jambo-app/id123456789",
      },
      variants: [
        {
          name: "Jambo App (Customer)",
          playStore: "https://play.google.com/store/apps/details?id=com.jamboapp.customer&pcampaignid=web_share",
          appStore: "https://apps.apple.com/app/jambo-app/id123456789",
        },
        {
          name: "Jambo Courier",
          playStore: "https://play.google.com/store/apps/details?id=com.jamboappltd.jamboapp_courier&pcampaignid=web_share",
          appStore: "https://apps.apple.com/app/jambo-courier/id123456790",
        },
        {
          name: "Jambo Merchant",
          playStore: "https://play.google.com/store/apps/details?id=com.jamboapp.merchant&pcampaignid=web_share",
          appStore: "https://apps.apple.com/app/jambo-merchant/id123456791",
        },
      ],
    },
    {
      title: "Happy Hoe Grocery",
      category: "Web Application",
      description: "A full-stack inventory and stock management system for efficient tracking of products, inventory movement, and administrative operations.",
      technologies: ["Python", "Django", "REST API", "MySQL"],
      highlights: [
        "Built complete backend system with Django",
        "Created dashboard interfaces for stock monitoring",
        "Developed REST API endpoints for system integration",
        "Implemented role-based access control",
      ],
      github: "https://github.com/Melissa9mpenzi",
    },
  ];

  const websitePortfolio = [
    { name: "Lwegatech", url: "http://lwegatech.com/" },
    { name: "ABC Capital Bank", url: "https://abccapitalbank.co.ug/" },
    { name: "UEGCL", url: "https://uegcl.com/" },
    { name: "Honorable Vessels Online Connect", url: "https://honorablevesselsonlineconnect.org/" },
    { name: "Hopeline Action Uganda", url: "https://hopelineactionuganda.org/" },
    { name: "Dialus Tours and Travel", url: "https://dialustoursandtravel.com/" },
    { name: "Aliyah Orphanage", url: "https://aliyahorphanage.org/" },
    { name: "Alpha East Africa", url: "https://alphaeastafrica.com/" },
    { name: "The Traveler Portal", url: "https://thetravelerportal.com/" },
    { name: "Dialus Logistics", url: "https://dialuslogistics.com/" },
    { name: "Kasenga Realty", url: "https://lwegatech.net/kasenga-realty/" },
    { name: "256 Youth Platform", url: "https://256youthplatform.org/" },
    { name: "Libertyscope", url: "https://libertyscope.co.ug/" },
    { name: "Ngazi Arts", url: "http://ngaziarts.com/" },
  ];

  return (
    <section id="projects" className="py-20 bg-gradient-to-br from-gray-50 to-purple-50 dark:from-gray-800 dark:to-gray-900">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Featured <span className="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Projects</span>
          </h2>
          <div className="w-20 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-4"></div>
          <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            A selection of projects I've built and contributed to
          </p>
        </div>

        {/* Featured Projects */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
          {featuredProjects.map((project, idx) => (
            <div
              key={idx}
              className="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105"
            >
              <div className="p-8">
                <div className="flex items-start justify-between mb-4">
                  <div>
                    <span className="text-sm font-semibold text-primary bg-primary/10 px-3 py-1 rounded-full">
                      {project.category}
                    </span>
                  </div>
                  <div className="flex space-x-3">
                    {project.link && (
                      <a
                        href={project.link}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="text-gray-600 dark:text-gray-400 hover:text-primary transition-colors"
                        aria-label="View project"
                      >
                        <FaExternalLinkAlt size={20} />
                      </a>
                    )}
                    {project.github && (
                      <a
                        href={project.github}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="text-gray-600 dark:text-gray-400 hover:text-primary transition-colors"
                        aria-label="View on GitHub"
                      >
                        <FaGithub size={20} />
                      </a>
                    )}
                  </div>
                </div>

                <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                  {project.title}
                </h3>
                <p className="text-gray-600 dark:text-gray-300 mb-4">
                  {project.description}
                </p>

                <div className="mb-4">
                  <h4 className="text-sm font-semibold text-gray-900 dark:text-white mb-2">Key Highlights:</h4>
                  <ul className="space-y-1">
                    {project.highlights.map((highlight, hIdx) => (
                      <li key={hIdx} className="text-sm text-gray-600 dark:text-gray-400 flex items-start">
                        <span className="text-primary mr-2">•</span>
                        <span>{highlight}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                <div className="flex flex-wrap gap-2 mb-4">
                  {project.technologies.map((tech, techIdx) => (
                    <span
                      key={techIdx}
                      className="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-xs font-medium"
                    >
                      {tech}
                    </span>
                  ))}
                </div>

                {/* App Store Downloads */}
                {project.variants && (
                  <div className="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h4 className="text-sm font-semibold text-gray-900 dark:text-white mb-4">Download Apps:</h4>
                    <div className="space-y-4">
                      {project.variants.map((variant, vIdx) => (
                        <div key={vIdx} className="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 rounded-lg p-4">
                          <h5 className="font-semibold text-gray-900 dark:text-white mb-3 text-sm">{variant.name}</h5>
                          <div className="flex flex-col sm:flex-row gap-2">
                            <a
                              href={variant.playStore}
                              target="_blank"
                              rel="noopener noreferrer"
                              className="flex items-center justify-center gap-2 px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium flex-1"
                            >
                              <FaGooglePlay size={16} />
                              <span>Google Play</span>
                            </a>
                            <a
                              href={variant.appStore}
                              target="_blank"
                              rel="noopener noreferrer"
                              className="flex items-center justify-center gap-2 px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium flex-1"
                            >
                              <FaApple size={16} />
                              <span>App Store</span>
                            </a>
                          </div>
                        </div>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            </div>
          ))}
        </div>

        {/* Website Portfolio */}
        <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
          <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
            Website Portfolio
          </h3>
          <p className="text-center text-gray-600 dark:text-gray-300 mb-8">
            Professional websites I've designed, developed, and deployed
          </p>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            {websitePortfolio.map((site, idx) => (
              <a
                key={idx}
                href={site.url}
                target="_blank"
                rel="noopener noreferrer"
                className="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600 rounded-lg hover:from-primary/20 hover:to-secondary/20 transition-all duration-300 transform hover:scale-105"
              >
                <span className="text-gray-700 dark:text-gray-200 font-medium text-sm group-hover:text-primary transition-colors">
                  {site.name}
                </span>
                <FaExternalLinkAlt className="text-gray-400 group-hover:text-primary transition-colors" size={14} />
              </a>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
};

export default Projects;
