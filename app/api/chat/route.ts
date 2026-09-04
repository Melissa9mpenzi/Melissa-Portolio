import { NextRequest, NextResponse } from "next/server";
import Groq from "groq-sdk";

export async function POST(req: NextRequest) {
  try {
    const { messages } = await req.json();

    // Basic validation
    if (!messages || !Array.isArray(messages)) {
      return NextResponse.json(
        { error: "Invalid messages format" },
        { status: 400 }
      );
    }

    if (!process.env.GROQ_API_KEY) {
      return NextResponse.json(
        {
          error:
            "The chatbot is not configured yet. Add GROQ_API_KEY to the Vercel environment variables.",
        },
        { status: 503 }
      );
    }

    const client = new Groq({ apiKey: process.env.GROQ_API_KEY });

    // Prep messages with System Prompt for Groq
    const groqMessages = [
      {
        role: "system",
        content:
          "You are a helpful and friendly portfolio assistant named 'MPENZI'. " +
          "You assist visitors on Melissa Sharon Lokoroma's portfolio website. " +
          "Melissa is a Full-Stack Software Engineer with expertise in React, Next.js, Node.js, TypeScript, Python, and mobile development. " +
          "She has worked on projects like Jambo App (multi-vendor delivery platform), Bora ERP systems, and various web applications. " +
          "Be friendly, concise, and professional. Help users learn about Melissa's skills, experience, and projects. " +
          "If visitors need to contact her directly, provide her email: melissampenzi@gmail.com or phone: +256 759 933 134. " +
          "For urgent inquiries, you can direct them to WhatsApp: https://wa.me/256759933134",
      },
      ...messages,
    ];

    const response = await client.chat.completions.create({
      messages: groqMessages as any,
      model: process.env.GROQ_MODEL || "openai/gpt-oss-20b",
      max_tokens: 1024,
    });

    return NextResponse.json({
      reply: response.choices[0].message.content,
    });
  } catch (error: any) {
    console.error("Chat API Error:", error);

    // Provide a more graceful error if API key is missing
    if (error.status === 401) {
      return NextResponse.json(
        {
          error:
            "Authentication missing. Please ensure your Groq API key is configured.",
        },
        { status: 401 }
      );
    }

    return NextResponse.json(
      { error: "Something went wrong. Please try again later." },
      { status: 500 }
    );
  }
}
