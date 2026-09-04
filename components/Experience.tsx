"use client";

import { FaBriefcase, FaGraduationCap } from "react-icons/fa";

const Experience = () => {
  const experiences = [
    {
      type: "work",
      title: "Web Solutions Developer",
      company: "Lwegatech",
      location: "Kampala, Uganda",
      period: "2025 – Present",
      description: [
        "Design, develop, and maintain responsive web platforms for client organizations using PHP, React, and WordPress",
        "Build and integrate RESTful APIs in Python to power dynamic frontend interfaces",
        "Implement UI/UX improvements ensuring cross-browser compatibility and mobile responsiveness",
        "Manage hosting, deployment, domain setup, email configuration, and ongoing security maintenance",
        "Collaborate directly with clients and stakeholders to translate business requirements into functional web products",
      ],
    },
    {
      type: "work",
      title: "Frontend Developer Intern & Project Team Lead",
      company: "Outdoorsy Uganda",
      location: "Kampala, Uganda",
      period: "2024 – 2025",
      description: [
        "Contributed to frontend development and UI implementation for a WordPress-based hiking and adventure platform",
        "Designed responsive interfaces for hiking experience discovery and online booking workflows",
        "Supported integration of merchandise store functionality alongside tourism services",
        "Coordinated development activities as team lead and collaborated with fellow developers",
        "Participated in agile development processes including sprint planning and iterative feature improvements",
      ],
    },
  ];

  const education = [
    {
      degree: "Apprenticeship Programme",
      institution: "Refactory Academy",
      location: "Kampala, Uganda",
      period: "2024 – 2025",
      description: "680+ hours of software project development covering OOP, TDD, Design Patterns, CI/CD, BDD, UI/UX, and Refactoring",
    },
    {
      degree: "Certificate in Software Engineering with Python",
      institution: "Refactory Academy",
      location: "Kampala, Uganda",
      period: "2024",
      description: "240 hours covering Python, Django, HTML, CSS, Git/GitHub, Agile methodologies, Application Security, and Human-Centered Design",
    },
    {
      degree: "Product Management Certification",
      institution: "Refactory Academy",
      location: "Kampala, Uganda",
      period: "2025",
      description: "Product strategy, user research, product lifecycle management, agile methodologies, roadmap planning, and stakeholder management",
    },
  ];

  return (
    <section id="experience" className="py-20 bg-white dark:bg-gray-900">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Experience & <span className="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Education</span>
          </h2>
          <div className="w-20 h-1 bg-gradient-to-r from-primary to-secondary mx-auto"></div>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
          {/* Work Experience */}
          <div>
            <div className="flex items-center mb-8">
              <FaBriefcase className="text-3xl text-primary mr-3" />
              <h3 className="text-3xl font-bold text-gray-900 dark:text-white">Work Experience</h3>
            </div>
            <div className="space-y-8">
              {experiences.map((exp, idx) => (
                <div
                  key={idx}
                  className="relative pl-8 pb-8 border-l-2 border-primary/30 last:pb-0 hover:border-primary transition-colors duration-300"
                >
                  <div className="absolute -left-2 top-0 w-4 h-4 bg-primary rounded-full"></div>
                  <div className="bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-800 dark:to-gray-700 rounded-lg p-6 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <h4 className="text-xl font-bold text-gray-900 dark:text-white mb-2">
                      {exp.title}
                    </h4>
                    <div className="text-primary font-semibold mb-1">{exp.company}</div>
                    <div className="text-sm text-gray-600 dark:text-gray-400 mb-4">
                      {exp.period} • {exp.location}
                    </div>
                    <ul className="space-y-2">
                      {exp.description.map((item, itemIdx) => (
                        <li key={itemIdx} className="text-sm text-gray-700 dark:text-gray-300 flex items-start">
                          <span className="text-primary mr-2 mt-1">▹</span>
                          <span>{item}</span>
                        </li>
                      ))}
                    </ul>
                  </div>
                </div>
              ))}
            </div>
          </div>

          {/* Education */}
          <div>
            <div className="flex items-center mb-8">
              <FaGraduationCap className="text-3xl text-secondary mr-3" />
              <h3 className="text-3xl font-bold text-gray-900 dark:text-white">Education</h3>
            </div>
            <div className="space-y-8">
              {education.map((edu, idx) => (
                <div
                  key={idx}
                  className="relative pl-8 pb-8 border-l-2 border-secondary/30 last:pb-0 hover:border-secondary transition-colors duration-300"
                >
                  <div className="absolute -left-2 top-0 w-4 h-4 bg-secondary rounded-full"></div>
                  <div className="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-gray-800 dark:to-gray-700 rounded-lg p-6 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <h4 className="text-xl font-bold text-gray-900 dark:text-white mb-2">
                      {edu.degree}
                    </h4>
                    <div className="text-secondary font-semibold mb-1">{edu.institution}</div>
                    <div className="text-sm text-gray-600 dark:text-gray-400 mb-3">
                      {edu.period} • {edu.location}
                    </div>
                    <p className="text-sm text-gray-700 dark:text-gray-300">{edu.description}</p>
                  </div>
                </div>
              ))}

              {/* Additional Education */}
              <div className="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
                <h4 className="font-bold text-gray-900 dark:text-white mb-2">
                  Bishop Cipriano Kihangire Secondary School
                </h4>
                <p className="text-sm text-gray-600 dark:text-gray-400">Uganda Advanced Certificate of Education (UACE) • 2019</p>
              </div>
              <div className="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
                <h4 className="font-bold text-gray-900 dark:text-white mb-2">Gayaza High School</h4>
                <p className="text-sm text-gray-600 dark:text-gray-400">Uganda Certificate of Education (UCE) – Division One • 2017</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Experience;
