"use client";

import { motion } from "framer-motion";
import { FaCheckCircle } from "react-icons/fa";

const AboutPage = () => {
  const highlights = [
    "4+ years building modern web applications",
    "Expert in React, Next.js, WordPress & Python",
    "UI/UX design with Figma",
    "Full-stack development experience",
    "Deployed 18+ production websites",
    "Agile methodology & team leadership",
  ];

  return (
    <div className="h-full p-8 sm:p-16 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 overflow-y-auto">
      <motion.div
        initial={{ opacity: 0, y: 20 }}
        animate={{ opacity: 1, y: 0 }}
        className="max-w-4xl mx-auto"
      >
        <motion.h2
          initial={{ x: -50, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          className="text-4xl sm:text-5xl font-bold mb-6 bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent"
        >
          About Me
        </motion.h2>

        <motion.div
          initial={{ x: 50, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          transition={{ delay: 0.2 }}
          className="bg-white/70 backdrop-blur-sm rounded-2xl p-6 sm:p-8 shadow-xl mb-6"
        >
          <p className="text-lg text-gray-700 mb-4 leading-relaxed">
            I&apos;m a passionate{" "}
            <span className="font-bold text-purple-600">
              Software Engineer
            </span>{" "}
            with over{" "}
            <span className="font-bold text-pink-600">
              4 years of experience
            </span>{" "}
            building, customizing, and deploying modern websites and web
            applications.
          </p>
          <p className="text-lg text-gray-700 mb-4 leading-relaxed">
            My expertise spans across{" "}
            <span className="font-semibold">WordPress development</span>,{" "}
            <span className="font-semibold">frontend technologies</span>,{" "}
            <span className="font-semibold">responsive design</span>, and{" "}
            <span className="font-semibold">UI/UX implementation</span>.
          </p>
          <p className="text-lg text-gray-700 leading-relaxed">
            Currently at{" "}
            <span className="font-bold text-purple-600">Lwegatech</span>, I
            design and develop responsive web platforms using PHP, React,
            WordPress, and Python, collaborating directly with clients to
            deliver exceptional digital solutions.
          </p>
        </motion.div>

        <motion.div
          initial={{ y: 30, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          transition={{ delay: 0.4 }}
          className="grid grid-cols-1 sm:grid-cols-2 gap-4"
        >
          {highlights.map((highlight, index) => (
            <motion.div
              key={index}
              initial={{ scale: 0 }}
              animate={{ scale: 1 }}
              transition={{ delay: 0.5 + index * 0.1 }}
              whileHover={{ scale: 1.05, x: 10 }}
              className="flex items-start gap-3 bg-white/70 backdrop-blur-sm rounded-xl p-4 shadow-lg"
            >
              <FaCheckCircle
                className="text-green-500 mt-1 flex-shrink-0"
                size={20}
              />
              <span className="text-gray-700">{highlight}</span>
            </motion.div>
          ))}
        </motion.div>
      </motion.div>
    </div>
  );
};

export default AboutPage;
