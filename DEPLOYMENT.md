# Deployment Guide - Vercel

This guide will walk you through deploying your Next.js portfolio to Vercel step-by-step.

## 🚀 Quick Start (5 minutes)

### Step 1: Prepare Your Code

1. Make sure all your code is working locally:
   ```bash
   npm install
   npm run build
   npm start
   ```

2. If everything works, you're ready to deploy!

### Step 2: Push to GitHub

1. **Create a new repository on GitHub**
   - Go to [github.com](https://github.com)
   - Click the "+" icon → "New repository"
   - Name it (e.g., "portfolio" or "melissa-portfolio")
   - Choose "Public" or "Private"
   - Click "Create repository"

2. **Push your code**
   ```bash
   # Initialize git (if not already done)
   git init
   
   # Add all files
   git add .
   
   # Create first commit
   git commit -m "Initial commit: Portfolio website"
   
   # Add your GitHub repository
   git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
   
   # Push to GitHub
   git branch -M main
   git push -u origin main
   ```

### Step 3: Deploy to Vercel

1. **Sign up / Log in to Vercel**
   - Go to [vercel.com](https://vercel.com)
   - Click "Sign Up" or "Log In"
   - Sign in with your GitHub account

2. **Import your project**
   - Click "Add New..." → "Project"
   - Select your GitHub repository from the list
   - Click "Import"

3. **Configure your project** (Usually auto-detected)
   - **Framework Preset**: Next.js (auto-detected)
   - **Build Command**: `npm run build` (auto-filled)
   - **Output Directory**: `.next` (auto-filled)
   - **Install Command**: `npm install` (auto-filled)

4. **Deploy!**
   - Click "Deploy"
   - Wait 2-3 minutes for build to complete
   - Your site is now live! 🎉

5. **Get your URL**
   - Vercel will provide a URL like: `your-project.vercel.app`
   - You can customize this or add your own domain

## 🔄 Automatic Deployments

Once connected, Vercel automatically:
- ✅ Deploys every push to `main` branch
- ✅ Creates preview deployments for pull requests
- ✅ Rebuilds when you push changes

To update your site:
```bash
git add .
git commit -m "Update portfolio"
git push
```

Vercel will automatically rebuild and deploy!

## 🌐 Custom Domain (Optional)

### Add Your Own Domain

1. **In Vercel Dashboard**
   - Go to your project
   - Click "Settings" → "Domains"
   - Enter your domain name
   - Click "Add"

2. **Update DNS Settings**
   - Vercel will show you the DNS records needed
   - Add these records to your domain provider:
     - **CNAME Record**: `www` → `cname.vercel-dns.com`
     - **A Record**: `@` → `76.76.21.21`

3. **Wait for DNS propagation** (can take up to 48 hours)

## ⚙️ Environment Variables

If you set up email functionality:

1. **In Vercel Dashboard**
   - Go to your project
   - Click "Settings" → "Environment Variables"

2. **Add variables**
   ```
   SENDGRID_API_KEY = your_sendgrid_api_key
   SENDGRID_FROM_EMAIL = melissampenzi@gmail.com
   CONTACT_EMAIL = melissampenzi@gmail.com
   ```

3. **Redeploy**
   - Go to "Deployments"
   - Click "..." on latest deployment
   - Click "Redeploy"

## 📊 Analytics (Free)

Enable Vercel Analytics to track visitors:

1. Go to your project dashboard
2. Click "Analytics" tab
3. Click "Enable Analytics"
4. Free plan includes:
   - Page views
   - Unique visitors
   - Top pages
   - Referrers

## 🔍 Monitoring

### Check Build Logs

If deployment fails:
1. Go to "Deployments" tab
2. Click on the failed deployment
3. Check "Build Logs" for errors

### Common Issues

**Build fails**:
- Check `package.json` dependencies
- Run `npm run build` locally first
- Check error messages in build logs

**Contact form doesn't work**:
- Check API route at `/api/contact`
- Verify environment variables are set
- Check browser console for errors

**Images don't load**:
- Make sure images are in `public/` folder
- Use correct paths: `/image.png` not `./image.png`

## 📱 Performance Tips

Vercel automatically provides:
- ✅ Global CDN
- ✅ Automatic HTTPS
- ✅ Compression
- ✅ Edge caching
- ✅ Image optimization
- ✅ Automatic minification

## 🆘 Getting Help

**Vercel Docs**: https://vercel.com/docs
**Vercel Support**: support@vercel.com
**Next.js Docs**: https://nextjs.org/docs

## ✅ Post-Deployment Checklist

- [ ] Site loads correctly
- [ ] All sections are visible
- [ ] Navigation works
- [ ] CV downloads successfully
- [ ] Contact form submits (check API logs)
- [ ] Mobile responsive
- [ ] All external links work
- [ ] Analytics enabled (optional)
- [ ] Custom domain configured (optional)

## 🎉 You're Live!

Share your portfolio:
- Update your LinkedIn profile
- Add to your GitHub profile README
- Share on social media
- Add to your email signature

Your portfolio URL: `https://your-project.vercel.app`

---

**Need help?** Contact me at melissampenzi@gmail.com
