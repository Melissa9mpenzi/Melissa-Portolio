# Chatbot Deployment Guide

## Overview
Your portfolio now includes an AI-powered chatbot assistant named "MPENZI" powered by Groq's LLaMA 3.1 model.

## Features
- 💬 Floating chat bubble in the bottom-right corner
- 🤖 AI assistant that knows about your skills, projects, and experience
- 🌓 Works with light/dark mode
- ✨ Smooth animations with Framer Motion
- 📱 Responsive design for mobile and desktop

## How to Deploy on Vercel

### Step 1: Add Environment Variable
1. Go to your Vercel dashboard: https://vercel.com/dashboard
2. Select your project: **Melissa-Portolio**
3. Click on **Settings** tab
4. Click on **Environment Variables** in the sidebar
5. Add the following variable:
   - **Key**: `GROQ_API_KEY`
   - **Value**: Copy the API key from your `chatbot/.env` file (starts with `gsk_`)
   - **Environment**: Select all (Production, Preview, Development)
6. Click **Save**

### Step 2: Redeploy
After adding the environment variable, you have two options:

**Option A: Automatic Deployment (Recommended)**
- Vercel will automatically redeploy when it detects the new commit on GitHub
- Wait for the deployment to complete (usually 2-3 minutes)

**Option B: Manual Redeploy**
1. Go to the **Deployments** tab
2. Click on the three dots (...) next to the latest deployment
3. Select **Redeploy**
4. Confirm the redeployment

### Step 3: Verify
1. Visit your deployed site
2. Look for the pink chat bubble in the bottom-right corner
3. Click it to open the chatbot
4. Send a test message like "Tell me about Melissa's experience"
5. The bot should respond with information about your portfolio

## Chatbot Behavior

### What the Bot Knows:
- Your full-stack development skills (React, Next.js, Node.js, TypeScript, Python)
- Your projects (Jambo App, Bora ERP systems, websites)
- Your contact information (email and phone)
- General information about your experience and expertise

### Contact Redirection:
- If someone asks to speak with a human or needs urgent help, the bot will provide:
  - Email: melissampenzi@gmail.com
  - Phone: +256 765 022 499
  - WhatsApp: https://wa.me/256765022499

## Files Created/Modified

### New Files:
- `components/ChatBot.tsx` - The chatbot React component
- `app/api/chat/route.ts` - API endpoint that calls Groq AI
- `.env.local` - Local environment variables (not committed to git)

### Modified Files:
- `app/layout.tsx` - Added ChatBot component to the layout
- `.gitignore` - Excluded chatbot folder and env files

## Testing Locally

To test the chatbot on your local machine:

```bash
# Make sure you have the .env.local file in your root directory
# It should contain your Groq API key:
# GROQ_API_KEY=your_actual_api_key_here

# Run the development server
npm run dev

# Open http://localhost:3000
# Click the chat bubble to test
```

## Troubleshooting

### Chatbot not responding:
1. Check if the GROQ_API_KEY is set correctly in Vercel
2. Check the browser console for errors (F12 → Console tab)
3. Verify the API route is accessible: https://your-site.vercel.app/api/chat

### Chat bubble not visible:
1. Clear your browser cache (Ctrl+Shift+Delete)
2. Check if ChatBot component is imported in app/layout.tsx
3. Try disabling browser extensions (ad blockers might hide it)

### API Key Issues:
- If you get "Authentication missing" errors, verify the API key is correct
- Groq API keys start with "gsk_"
- Make sure you've redeployed after adding the environment variable

## Security Notes

- ✅ The `.env.local` file is excluded from git (sensitive data not committed)
- ✅ The API key is only stored on Vercel and your local machine
- ✅ The chatbot folder with node_modules is excluded from git
- ⚠️ Never commit API keys to public repositories

## Next Steps

Once deployed, you can:
- Monitor chatbot usage in Vercel Analytics
- Customize the chatbot's personality in `app/api/chat/route.ts`
- Adjust the chatbot's appearance in `components/ChatBot.tsx`
- Add more context about your projects in the system prompt

---

**Note**: Your existing chatbot in the `/chatbot` folder is independent and not affected by this integration. The new chatbot is built specifically for Next.js and Vercel deployment.
