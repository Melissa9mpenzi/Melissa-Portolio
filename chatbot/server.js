require("dotenv").config();
const express = require("express");
const cors = require("cors");
const Groq = require("groq-sdk");

const app = express();
const client = new Groq({ apiKey: process.env.GROQ_API_KEY });

app.use(cors()); // Restrict this to your domain in production
app.use(express.json());
app.use(express.static("public"));

app.post("/chat", async (req, res) => {
  const { messages } = req.body;

  // Basic validation
  if (!messages || !Array.isArray(messages)) {
    return res.status(400).json({ error: "Invalid messages format" });
  }

  try {
    // Prep messages with System Prompt for Groq
    const groqMessages = [
      {
        role: "system",
        content: "You are a helpful and friendly online assistant named 'MPENZI'. " +
                 "Be friendly, concise, and professional. " +
                 "Your main goal is to assist users on our website. As part of your task, if they need more detailed advice, politely ask for their phone number and email address. " +
                 "CRITICAL INSTRUCTION: If a user asks to speak to a human, customer service, or a real person, redirect them to our WhatsApp support. Tell them our WhatsApp number is 0765022499 and provide this HTML link so they can click it directly: <br><br><a href='https://wa.me/256765022499' target='_blank' style='color:#ff6b9e; font-weight:bold; text-decoration:underline;'>💬 Click here to chat with a human on WhatsApp</a>"
      },
      ...messages
    ];

    const response = await client.chat.completions.create({
      messages: groqMessages,
      model: "llama-3.1-8b-instant",
      max_tokens: 1024,
    });

    res.json({ reply: response.choices[0].message.content });
  } catch (error) {
    console.error(error);
    
    // Provide a more graceful error if API key is missing
    if(error.status === 401) {
      res.status(401).json({ error: "Authentication missing. Please ensure your Groq API key is valid in the .env file."});
    } else {
      res.status(500).json({ error: "Something went wrong. Please try again later." });
    }
  }
});

app.listen(3000, () => console.log("Server running on http://localhost:3000"));
