"use client";

import { motion } from "framer-motion";
import { FaGooglePlay, FaApple, FaExternalLinkAlt } from "react-icons/fa";

const ProjectsPage = () => {
  return (
    <div className="h-full p-8 sm:p-16 bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 overflow-y-auto">
      <motion.h2
        initial={{ scale: 0 }}
        animate={{ scale: 1 }}
        className="text-4xl sm:text-5xl font-bold mb-8 text-center bg-gradient-to-r from-pink-600 to-blue-600 bg-clip-text text-transparent"
      >
        Featured Projects
      </motion.h2>

      <div className="max-w-5xl mx-auto space-y-6">
        {/* Jambo App */}
        <motion.div
          initial={{ y: 30, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          transition={{ delay: 0.2 }}
          whileHover={{ scale: 1.02 }}
          className="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-2xl"
        >
          <div className="flex items-start justify-between mb-4">
            <div>
              <h3 className="text-2xl font-bold text-gray-800 mb-1">Jambo App</h3>
              <span className="text-sm bg-pink-100 text-pink-700 px-3 py-1 rounded-full font-semibold">
                Mobile Application
              </span>
            </div>
            <a
              href="https://jamboapp.io/"
              target="_blank"
              rel="noopener noreferrer"
              className="text-purple-600 hover:text-purple-800"
            >
              <FaExternalLinkAlt size={20} />
            </a>
          </div>

          <p className="text-gray-600 mb-4">
            Cross-platform food delivery solution with real-time tracking. Built with Flutter.
          </p>

          <div className="space-y-3">
            {[
              {
                name: "Jambo App (Customer)",
                playStore: "https://play.google.com/store/apps/details?id=com.jamboapp.customer&pcampaignid=web_share",
              },
              {
                name: "Jambo Courier",
                playStore: "https://play.google.com/store/apps/details?id=com.jamboappltd.jamboapp_courier&pcampaignid=web_share",
              },
              {
                name: "Jambo Merchant",
                playStore: "https://play.google.com/store/apps/details?id=com.jamboapp.merchant&pcampaignid=web_share",
              },
            ].map((app, index) => (
              <motion.div
                key={index}
                initial={{ x: -20, opacity: 0 }}
                animate={{ x: 0, opacity: 1 }}
                transition={{ delay: 0.3 + index * 0.1 }}
                className="bg-gradient-to-r from-pink-50 to-purple-50 rounded-lg p-3"
              >
                <p className="font-semibold text-sm text-gray-700 mb-2">{app.name}</p>
                <div className="flex gap-2">
                  <a
                    href={app.playStore}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="flex items-center gap-2 px-3 py-2 bg-black text-white rounded-lg text-xs font-medium hover:bg-gray-800 transition-colors"
                  >
                    <FaGooglePlay />
                    <span>Google Play</span>
                  </a>
                  <a
                    href="#"
                    className="flex items-center gap-2 px-3 py-2 bg-black text-white rounded-lg text-xs font-medium hover:bg-gray-800 transition-colors"
                  >
                    <FaApple />
                    <span>App Store</span>
                  </a>
                </div>
              </motion.div>
            ))}
          </div>
        </motion.div>

        {/* Happy Hoe Grocery */}
        <motion.div
          initial={{ y: 30, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          transition={{ delay: 0.5 }}
          whileHover={{ scale: 1.02 }}
          className="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-2xl"
        >
          <h3 className="text-2xl font-bold text-gray-800 mb-1">Happy Hoe Grocery</h3>
          <span className="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold inline-block mb-3">
            Web Application
          </span>
          <p className="text-gray-600 mb-3">
            Full-stack inventory management system built with Python & Django.
          </p>
          <div className="flex flex-wrap gap-2">
            {["Python", "Django", "REST API", "MySQL"].map((tech, index) => (
              <span
                key={index}
                className="px-3 py-1 bg-gray-100 rounded-full text-xs font-medium text-gray-700"
              >
                {tech}
              </span>
            ))}
          </div>
        </motion.div>
      </div>
    </div>
  );
};

export default ProjectsPage;
