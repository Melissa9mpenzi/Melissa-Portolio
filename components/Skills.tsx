"use client";

import { FaReact, FaWordpress, FaPython, FaJs, FaHtml5, FaCss3Alt, FaFigma, FaGitAlt, FaNodeJs } from "react-icons/fa";
import { SiNextdotjs, SiDjango, SiTailwindcss, SiFlutter, SiTypescript, SiPhp, SiMysql } from "react-icons/si";

const Skills = () => {
  const skillCategories = [
    {
      title: "Frontend Development",
      skills: [
        { name: "React.js", icon: <FaReact className="text-4xl text-cyan-400" /> },
        { name: "Next.js", icon: <SiNextdotjs className="text-4xl text-gray-900 dark:text-white" /> },
        { name: "TypeScript", icon: <SiTypescript className="text-4xl text-blue-600" /> },
        { name: "JavaScript", icon: <FaJs className="text-4xl text-yellow-400" /> },
        { name: "HTML5", icon: <FaHtml5 className="text-4xl text-orange-600" /> },
        { name: "CSS3", icon: <FaCss3Alt className="text-4xl text-blue-500" /> },
        { name: "Tailwind CSS", icon: <SiTailwindcss className="text-4xl text-teal-400" /> },
        { name: "Flutter", icon: <SiFlutter className="text-4xl text-blue-400" /> },
      ],
    },
    {
      title: "Backend & CMS",
      skills: [
        { name: "Python", icon: <FaPython className="text-4xl text-blue-500" /> },
        { name: "Django", icon: <SiDjango className="text-4xl text-green-700" /> },
        { name: "PHP", icon: <SiPhp className="text-4xl text-indigo-600" /> },
        { name: "Node.js", icon: <FaNodeJs className="text-4xl text-green-600" /> },
        { name: "WordPress", icon: <FaWordpress className="text-4xl text-blue-600" /> },
        { name: "MySQL", icon: <SiMysql className="text-4xl text-blue-700" /> },
      ],
    },
    {
      title: "Tools & Design",
      skills: [
        { name: "Figma", icon: <FaFigma className="text-4xl text-purple-600" /> },
        { name: "Git & GitHub", icon: <FaGitAlt className="text-4xl text-orange-600" /> },
      ],
    },
  ];

  const additionalSkills = [
    "REST API Development",
    "Responsive Web Design",
    "Mobile-First Development",
    "Cross-Browser Compatibility",
    "Website Optimization",
    "Domain & Hosting Management",
    "cPanel & Hostinger",
    "Authentication Systems",
    "Agile Methodologies",
    "UI/UX Implementation",
  ];

  return (
    <section id="skills" className="py-20 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-800 dark:to-gray-900">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Technical <span className="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Skills</span>
          </h2>
          <div className="w-20 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mb-4"></div>
          <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            Technologies and tools I use to bring ideas to life
          </p>
        </div>

        {/* Main Skills with Icons */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
          {skillCategories.map((category, idx) => (
            <div
              key={idx}
              className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 hover:shadow-2xl transition-shadow duration-300"
            >
              <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                {category.title}
              </h3>
              <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 gap-6">
                {category.skills.map((skill, skillIdx) => (
                  <div
                    key={skillIdx}
                    className="flex flex-col items-center justify-center p-4 rounded-lg bg-gray-50 dark:bg-gray-700 hover:bg-gradient-to-br hover:from-primary/10 hover:to-secondary/10 transition-all duration-300 transform hover:scale-105"
                  >
                    {skill.icon}
                    <span className="text-sm font-medium text-gray-700 dark:text-gray-300 mt-2 text-center">
                      {skill.name}
                    </span>
                  </div>
                ))}
              </div>
            </div>
          ))}
        </div>

        {/* Additional Skills */}
        <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
          <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
            Additional Expertise
          </h3>
          <div className="flex flex-wrap justify-center gap-3">
            {additionalSkills.map((skill, idx) => (
              <span
                key={idx}
                className="px-4 py-2 bg-gradient-to-r from-primary/10 to-secondary/10 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium hover:from-primary/20 hover:to-secondary/20 transition-all duration-300 border border-primary/20"
              >
                {skill}
              </span>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
};

export default Skills;
