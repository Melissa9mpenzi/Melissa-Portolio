"use client";

import { motion } from "framer-motion";
import { FaBriefcase, FaGraduationCap } from "react-icons/fa";

const ExperiencePage = () => {
  return (
    <div className="h-full p-8 sm:p-16 bg-gradient-to-br from-orange-50 via-pink-50 to-purple-50 overflow-y-auto">
      <motion.h2
        initial={{ y: -20, opacity: 0 }}
        animate={{ y: 0, opacity: 1 }}
        className="text-4xl sm:text-5xl font-bold mb-8 text-center bg-gradient-to-r from-orange-600 to-purple-600 bg-clip-text text-transparent"
      >
        Experience
      </motion.h2>

      <div className="max-w-4xl mx-auto space-y-6">
        {/* Work Experience */}
        <motion.div
          initial={{ x: -50, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          transition={{ delay: 0.2 }}
          className="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-xl"
        >
          <div className="flex items-start gap-4">
            <div className="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center flex-shrink-0">
              <FaBriefcase className="text-white" size={24} />
            </div>
            <div className="flex-1">
              <h3 className="text-xl font-bold text-gray-800">Web Solutions Developer</h3>
              <p className="text-purple-600 font-semibold">Lwegatech</p>
              <p className="text-sm text-gray-500 mb-2">2025 – Present | Kampala, Uganda</p>
              <ul className="text-sm text-gray-600 space-y-1">
                <li>• Design & develop responsive web platforms with PHP, React, WordPress, Python</li>
                <li>• Build & integrate RESTful APIs for dynamic interfaces</li>
                <li>• Manage hosting, deployment, domain setup & security</li>
              </ul>
            </div>
          </div>
        </motion.div>

        <motion.div
          initial={{ x: -50, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          transition={{ delay: 0.3 }}
          className="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-xl"
        >
          <div className="flex items-start gap-4">
            <div className="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center flex-shrink-0">
              <FaBriefcase className="text-white" size={24} />
            </div>
            <div className="flex-1">
              <h3 className="text-xl font-bold text-gray-800">Frontend Developer & Team Lead</h3>
              <p className="text-blue-600 font-semibold">Outdoorsy Uganda</p>
              <p className="text-sm text-gray-500 mb-2">2024 – 2025 | Kampala, Uganda</p>
              <ul className="text-sm text-gray-600 space-y-1">
                <li>• Led team in building WordPress-based hiking & adventure platform</li>
                <li>• Designed responsive UI for booking workflows</li>
                <li>• Coordinated agile development sprints</li>
              </ul>
            </div>
          </div>
        </motion.div>

        {/* Education */}
        <motion.div
          initial={{ x: 50, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          transition={{ delay: 0.4 }}
          className="bg-gradient-to-r from-green-500/10 to-blue-500/10 backdrop-blur-sm rounded-2xl p-6 shadow-xl"
        >
          <div className="flex items-start gap-4">
            <div className="w-12 h-12 bg-gradient-to-br from-green-500 to-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
              <FaGraduationCap className="text-white" size={24} />
            </div>
            <div className="flex-1">
              <h3 className="text-xl font-bold text-gray-800">Software Engineering</h3>
              <p className="text-green-600 font-semibold">Refactory Academy</p>
              <p className="text-sm text-gray-500 mb-2">2024 – 2025</p>
              <ul className="text-sm text-gray-600 space-y-1">
                <li>• 680+ hours software project development</li>
                <li>• Python, Django, HTML/CSS, Git/GitHub</li>
                <li>• Product Management Certification</li>
              </ul>
            </div>
          </div>
        </motion.div>
      </div>
    </div>
  );
};

export default ExperiencePage;
