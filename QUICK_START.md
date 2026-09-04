# 🚀 Quick Start Guide

Your portfolio is now on GitHub! Here's what to do next:

## ✅ Step 1: Install Dependencies (Required)

Before deploying, you need to install the project dependencies:

```bash
npm install
```

This will install all necessary packages like React, Next.js, Tailwind CSS, etc.

## ✅ Step 2: Test Locally (Optional but Recommended)

Test your portfolio locally before deploying:

```bash
npm run dev
```

Open [http://localhost:3000](http://localhost:3000) in your browser.

## ✅ Step 3: Deploy to Vercel (5 minutes)

### Option A: Vercel Dashboard (Easiest)

1. **Go to Vercel**
   - Visit [vercel.com](https://vercel.com)
   - Click "Sign Up" and sign in with GitHub

2. **Import Your Repository**
   - Click "Add New..." → "Project"
   - Find "Melissa-Portolio" in your repositories
   - Click "Import"

3. **Configure (Auto-filled)**
   - Framework: Next.js ✓
   - Root Directory: ./
   - Build Command: `npm run build` ✓
   - Click "Deploy"

4. **Wait 2-3 minutes** ☕
   - Your site will be live at: `melissa-portolio.vercel.app`

### Option B: Vercel CLI (Alternative)

```bash
# Install Vercel CLI
npm install -g vercel

# Login
vercel login

# Deploy
vercel

# Deploy to production
vercel --prod
```

## 📱 Important: Update Jambo App Store Links

Before deploying, you should update the actual app store links in `components/Projects.tsx`:

**Current placeholder links need to be replaced with real ones:**

```typescript
// Line ~20-40 in components/Projects.tsx
variants: [
  {
    name: "Jambo App (Customer)",
    playStore: "YOUR_ACTUAL_PLAY_STORE_LINK_HERE",
    appStore: "YOUR_ACTUAL_APP_STORE_LINK_HERE",
  },
  {
    name: "Jambo Courier",
    playStore: "YOUR_ACTUAL_PLAY_STORE_LINK_HERE",
    appStore: "YOUR_ACTUAL_APP_STORE_LINK_HERE",
  },
  {
    name: "Jambo Merchant",
    playStore: "YOUR_ACTUAL_PLAY_STORE_LINK_HERE",
    appStore: "YOUR_ACTUAL_APP_STORE_LINK_HERE",
  },
]
```

**After updating:**
```bash
git add components/Projects.tsx
git commit -m "Update Jambo app store links"
git push
```

Vercel will automatically redeploy with the new links!

## 🎨 Customization

### Change Colors
Edit `tailwind.config.ts`:
```typescript
colors: {
  primary: '#3b82f6',    // Your color here
  secondary: '#8b5cf6',  // Your color here
  accent: '#ec4899',     // Your color here
}
```

### Update Content
- **About**: Edit `components/About.tsx`
- **Experience**: Edit `components/Experience.tsx`
- **Projects**: Edit `components/Projects.tsx`
- **Skills**: Edit `components/Skills.tsx`
- **Contact**: Edit `components/Contact.tsx`

### Replace CV
Replace `public/Melissa_Sharon_Lokoroma_CV.pdf` with your updated CV.

## 📧 Enable Contact Form Emails (Optional)

The contact form currently logs submissions. To receive emails:

1. **Sign up for SendGrid** (Free tier: 100 emails/day)
   - Go to [sendgrid.com](https://sendgrid.com)
   - Create account and get API key

2. **Install SendGrid**
   ```bash
   npm install @sendgrid/mail
   ```

3. **Add to Vercel Environment Variables**
   - Project Settings → Environment Variables
   - Add: `SENDGRID_API_KEY` = your_api_key
   - Add: `SENDGRID_FROM_EMAIL` = melissampenzi@gmail.com

4. **Update API Route**
   See instructions in `app/api/contact/route.ts`

## 🔄 Making Updates

Whenever you want to update your portfolio:

```bash
# Make your changes to files
# Then commit and push
git add .
git commit -m "Describe your changes"
git push
```

Vercel automatically redeploys on every push! 🎉

## 🌐 Your Links

After deployment, you'll have:
- **Live Site**: `https://melissa-portolio.vercel.app`
- **GitHub Repo**: https://github.com/Melissa9mpenzi/Melissa-Portolio
- **Vercel Dashboard**: Access from vercel.com

## 🆘 Common Issues

**Build fails on Vercel?**
- Run `npm install` and `npm run build` locally first
- Check error logs in Vercel dashboard

**Contact form doesn't work?**
- It's logging to console by default (working as intended)
- Follow email setup steps above to receive actual emails

**Need to make changes?**
- Edit files locally
- Test with `npm run dev`
- Push to GitHub
- Vercel auto-deploys

## 📱 Share Your Portfolio

Add your new portfolio URL to:
- ✅ LinkedIn profile
- ✅ GitHub profile README
- ✅ Resume/CV
- ✅ Email signature
- ✅ Twitter/X bio

## 🎉 You're All Set!

Your modern portfolio is live and ready to impress!

**Next Steps:**
1. Deploy to Vercel (5 minutes)
2. Update Jambo app store links
3. Test all features
4. Share with the world!

---

**Questions?** Contact melissampenzi@gmail.com
