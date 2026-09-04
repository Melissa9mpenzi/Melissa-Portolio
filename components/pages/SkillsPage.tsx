"use client";

import { motion } from "framer-motion";
import { FaReact, FaWordpress, FaPython, FaJs, FaHtml5, FaCss3Alt, FaFigma, FaGitAlt, FaNodeJs } from "react-icons/fa";
import { SiNextdotjs, SiDjango, SiTailwindcss, SiFlutter, SiTypescript, SiPhp, SiMysql } from "react-icons/si";

const SkillsPage = () => {
  const skillsData = [
    { name: "React", icon: FaReact, color: "#61DAFB" },
    { name: "Next.js", icon: SiNextdotjs, color: "#000000" },
    { name: "TypeScript", icon: SiTypescript, color: "#3178C6" },
    { name: "JavaScript", icon: FaJs, color: "#F7DF1E" },
    { name: "Python", icon: FaPython, color: "#3776AB" },
    { name: "Django", icon: SiDjango, color: "#092E20" },
    { name: "PHP", icon: SiPhp, color: "#777BB4" },
    { name: "Node.js", icon: FaNodeJs, color: "#339933" },
    { name: "WordPress", icon: FaWordpress, color: "#21759B" },
    { name: "Flutter", icon: SiFlutter, color: "#02569B" },
    { name: "HTML5", icon: FaHtml5, color: "#E34F26" },
    { name: "CSS3", icon: FaCss3Alt, color: "#1572B6" },
    { name: "Tailwind", icon: SiTailwindcss, color: "#06B6D4" },
    { name: "MySQL", icon: SiMysql, color: "#4479A1" },
    { name: "Figma", icon: FaFigma, color: "#F24E1E" },
    { name: "Git", icon: FaGitAlt, color: "#F05032" },
  ];

  return (
    <div className="h-full p-8 sm:p-16 bg-gradient-to-br from-cyan-50 via-blue-50 to-purple-50 overflow-y-auto">
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        className="max-w-5xl mx-auto"
      >
        <motion.h2
          initial={{ y: -30, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          className="text-4xl sm:text-5xl font-bold mb-8 text-center bg-gradient-to-r from-cyan-600 to-purple-600 bg-clip-text text-transparent"
        >
          Technical Skills
        </motion.h2>

        <motion.div
          initial={{ scale: 0.8, opacity: 0 }}
          animate={{ scale: 1, opacity: 1 }}
          transition={{ delay: 0.2 }}
          className="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6"
        >
          {skillsData.map((skill, index) => (
            <motion.div
              key={index}
              initial={{ scale: 0, rotate: -180 }}
              animate={{ scale: 1, rotate: 0 }}
              transition={{
                delay: 0.3 + index * 0.05,
                type: "spring",
                stiffness: 200,
              }}
              whileHover={{
                scale: 1.15,
                rotate: [0, -5, 5, 0],
                transition: { duration: 0.3 },
              }}
              className="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-xl flex flex-col items-center justify-center gap-3 cursor-pointer group"
            >
              <motion.div
                whileHover={{ rotate: 360 }}
                transition={{ duration: 0.6 }}
              >
                <skill.icon
                  size={48}
                  style={{ color: skill.color }}
                  className="group-hover:drop-shadow-lg transition-all"
                />
              </motion.div>
              <span className="text-sm font-semibold text-gray-700 text-center">
                {skill.name}
              </span>
            </motion.div>
          ))}
        </motion.div>

        <motion.div
          initial={{ y: 30, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          transition={{ delay: 1 }}
          className="mt-8 bg-gradient-to-r from-purple-500/10 to-pink-500/10 rounded-2xl p-6 backdrop-blur-sm"
        >
          <h3 className="text-xl font-bold text-gray-800 mb-4">Also Proficient In:</h3>
          <div className="flex flex-wrap gap-2">
            {[
              "REST APIs",
              "Responsive Design",
              "Mobile-First",
              "Cross-Browser",
              "cPanel",
              "Hostinger",
              "Authentication",
              "Agile",
              "UI/UX",
              "Git/GitHub",
            ].map((skill, index) => (
              <motion.span
                key={index}
                initial={{ scale: 0 }}
                animate={{ scale: 1 }}
                transition={{ delay: 1.2 + index * 0.05 }}
                whileHover={{ scale: 1.1 }}
                className="px-4 py-2 bg-white/80 rounded-full text-sm font-medium text-gray-700 shadow-md cursor-pointer"
              >
                {skill}
              </motion.span>
            ))}
          </div>
        </motion.div>
      </motion.div>
    </div>
  );
};

export default SkillsPage;
