"use client";

import { motion } from "framer-motion";
import { FaQuoteLeft, FaStar } from "react-icons/fa";

const TestimonialsPage = () => {
  const testimonials = [
    {
      name: "Your Friend Name",
      role: "CEO, Company Name",
      image: "/testimonial1.jpg", // Replace with actual image
      text: "Melissa is an exceptional developer with great attention to detail. Her work on our project exceeded all expectations and was delivered on time.",
      rating: 5,
    },
    {
      name: "Your Friend Name",
      role: "Project Manager, Tech Co",
      image: "/testimonial2.jpg", // Replace with actual image
      text: "Working with Melissa was a pleasure. She brought creative solutions to complex problems and her technical expertise is outstanding.",
      rating: 5,
    },
    {
      name: "Your Friend Name",
      role: "Founder, Startup",
      image: "/testimonial3.jpg", // Replace with actual image
      text: "Melissa transformed our vision into reality. Her professionalism and skill set make her stand out in the industry.",
      rating: 5,
    },
  ];

  return (
    <div className="h-full p-8 sm:p-16 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 overflow-y-auto">
      <motion.h2
        initial={{ scale: 0 }}
        animate={{ scale: 1 }}
        className="text-4xl sm:text-5xl font-bold mb-4 text-center bg-gradient-to-r from-indigo-600 to-pink-600 bg-clip-text text-transparent"
      >
        Testimonials
      </motion.h2>

      <motion.p
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ delay: 0.2 }}
        className="text-center text-gray-600 mb-12"
      >
        What people say about working with me
      </motion.p>

      <div className="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {testimonials.map((testimonial, index) => (
          <motion.div
            key={index}
            initial={{ y: 50, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            transition={{ delay: 0.3 + index * 0.2 }}
            whileHover={{ y: -10, scale: 1.02 }}
            className="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-xl relative"
          >
            {/* Quote Icon */}
            <div className="absolute top-4 right-4 text-purple-200">
              <FaQuoteLeft size={32} />
            </div>

            {/* Rating */}
            <div className="flex gap-1 mb-4">
              {[...Array(testimonial.rating)].map((_, i) => (
                <motion.div
                  key={i}
                  initial={{ scale: 0, rotate: -180 }}
                  animate={{ scale: 1, rotate: 0 }}
                  transition={{ delay: 0.5 + i * 0.1 }}
                >
                  <FaStar className="text-yellow-400" size={16} />
                </motion.div>
              ))}
            </div>

            {/* Testimonial Text */}
            <p className="text-gray-700 mb-6 italic">
              &quot;{testimonial.text}&quot;
            </p>

            {/* Author Info */}
            <div className="flex items-center gap-4">
              <div className="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold">
                {testimonial.name.charAt(0)}
              </div>
              <div>
                <p className="font-semibold text-gray-800">{testimonial.name}</p>
                <p className="text-sm text-gray-600">{testimonial.role}</p>
              </div>
            </div>
          </motion.div>
        ))}
      </div>

      {/* Add More Section */}
      <motion.div
        initial={{ y: 30, opacity: 0 }}
        animate={{ y: 0, opacity: 1 }}
        transition={{ delay: 1 }}
        className="max-w-3xl mx-auto mt-12 bg-gradient-to-r from-purple-500/10 to-pink-500/10 rounded-2xl p-8 text-center"
      >
        <h3 className="text-2xl font-bold text-gray-800 mb-3">Want to work together?</h3>
        <p className="text-gray-600 mb-4">
          Join the list of satisfied clients and let&apos;s create something amazing!
        </p>
        <motion.button
          whileHover={{ scale: 1.05 }}
          whileTap={{ scale: 0.95 }}
          onClick={() => window.location.href = '#contact'}
          className="px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full font-semibold shadow-lg hover:shadow-xl transition-all"
        >
          Get In Touch
        </motion.button>
      </motion.div>
    </div>
  );
};

export default TestimonialsPage;
