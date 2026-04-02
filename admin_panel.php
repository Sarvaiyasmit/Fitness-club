<?php
session_start();
// Auth Guard: Only logged-in admins can view this page
if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — FITNESS CLUB</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>

<div class="admin-wrapper">

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h2>FITNESS CLUB</h2>
            <p>Admin Panel</p>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Main</div>
            <div class="nav-item active" onclick="showSection('dashboard', this)">
                <span class="nav-icon">📊</span> Dashboard
            </div>
            <div class="nav-item" onclick="showSection('members', this)">
                <span class="nav-icon">👥</span> Members
                <span class="badge">128</span>
            </div>

            <div class="nav-label">Manage</div>
            <div class="nav-item" onclick="showSection('services', this)">
                <span class="nav-icon">⚡</span> Services
            </div>
            <div class="nav-item" onclick="showSection('blog', this)">
                <span class="nav-icon">📝</span> Blog Posts
            </div>
            <div class="nav-item" onclick="showSection('messages', this)">
                <span class="nav-icon">💬</span> Messages
                <span class="badge">14</span>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="admin-user">
                <div class="admin-avatar">A</div>
                <div class="admin-user-info">
                    <div class="name">Administrator</div>
                    <div class="role">Super Admin</div>
                </div>
            </div>
            <button class="btn-logout" onclick="doLogout()">🚪 Logout</button>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="main-content">

        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-left">
                <h2 id="pageTitle">Dashboard</h2>
                <div class="breadcrumb">Admin Panel &rsaquo; <span id="breadcrumbSub">Overview</span></div>
            </div>
            <div class="topbar-right">
                <div class="search-bar">
                    <span>🔍</span>
                    <input type="text" placeholder="Search…" id="globalSearch">
                </div>
                <button class="topbar-btn notification-dot" title="Notifications">🔔</button>
                <button class="topbar-btn" title="Toggle Sidebar" onclick="toggleSidebar()">☰</button>
            </div>
        </div>

        <!-- ==================== PAGE CONTENT ==================== -->
        <div class="page-content">

            <!-- ===== DASHBOARD SECTION ===== -->
            <div class="section active" id="section-dashboard">

                <!-- Welcome Banner -->
                <div class="welcome-banner">
                    <div>
                        <h1>Welcome back, Admin! 💪</h1>
                        <p>Here's what's happening with your gym today — Monday, March 2026.</p>
                    </div>
                    <div class="banner-emoji">🏆</div>
                </div>

                <!-- Stat Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon red">👥</div>
                        <div class="stat-info">
                            <div class="value" id="counter-members">0</div>
                            <div class="label">Total Members</div>
                            <div class="change up">↑ 12 new this month</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon blue">⚡</div>
                        <div class="stat-info">
                            <div class="value" id="counter-services">0</div>
                            <div class="label">Active Services</div>
                            <div class="change up">↑ All running</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green">📝</div>
                        <div class="stat-info">
                            <div class="value" id="counter-blog">0</div>
                            <div class="label">Blog Posts</div>
                            <div class="change up">↑ 1 new this week</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon yellow">💬</div>
                        <div class="stat-info">
                            <div class="value" id="counter-messages">0</div>
                            <div class="label">Messages</div>
                            <div class="change down">● 4 unread</div>
                        </div>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">

                    <!-- Recent Members -->
                    <div class="panel">
                        <div class="panel-header">
                            <div>
                                <h3>Recent Members</h3>
                                <div class="sub">Latest 5 registrations</div>
                            </div>
                            <button class="btn btn-outline btn-sm" onclick="showSection('members', document.querySelectorAll('.nav-item')[1])">View All</button>
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><div class="member-cell"><div class="member-avatar" style="background:#e63946">R</div><div><div class="member-name">Rahul Sharma</div><div class="member-email">rahul@gmail.com</div></div></div></td>
                                    <td>Male</td>
                                    <td><span class="status-badge active"><span class="status-dot"></span>Active</span></td>
                                </tr>
                                <tr>
                                    <td><div class="member-cell"><div class="member-avatar" style="background:#3b82f6">P</div><div><div class="member-name">Priya Patel</div><div class="member-email">priya@gmail.com</div></div></div></td>
                                    <td>Female</td>
                                    <td><span class="status-badge active"><span class="status-dot"></span>Active</span></td>
                                </tr>
                                <tr>
                                    <td><div class="member-cell"><div class="member-avatar" style="background:#10b981">A</div><div><div class="member-name">Arjun Mehta</div><div class="member-email">arjun@gmail.com</div></div></div></td>
                                    <td>Male</td>
                                    <td><span class="status-badge pending"><span class="status-dot"></span>Pending</span></td>
                                </tr>
                                <tr>
                                    <td><div class="member-cell"><div class="member-avatar" style="background:#f59e0b">S</div><div><div class="member-name">Sara Khan</div><div class="member-email">sara@gmail.com</div></div></div></td>
                                    <td>Female</td>
                                    <td><span class="status-badge active"><span class="status-dot"></span>Active</span></td>
                                </tr>
                                <tr>
                                    <td><div class="member-cell"><div class="member-avatar" style="background:#8b5cf6">V</div><div><div class="member-name">Vijay Singh</div><div class="member-email">vijay@gmail.com</div></div></div></td>
                                    <td>Male</td>
                                    <td><span class="status-badge inactive"><span class="status-dot"></span>Inactive</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Recent Activity -->
                    <div class="panel">
                        <div class="panel-header">
                            <div>
                                <h3>Recent Activity</h3>
                                <div class="sub">Latest events</div>
                            </div>
                        </div>
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-dot" style="background:rgba(16,185,129,.12); color:#10b981">✅</div>
                                <div class="activity-text">
                                    <div class="title">New member registered — Rahul Sharma</div>
                                    <div class="time">2 minutes ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot" style="background:rgba(59,130,246,.12); color:#3b82f6">💬</div>
                                <div class="activity-text">
                                    <div class="title">New contact message received</div>
                                    <div class="time">14 minutes ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot" style="background:rgba(230,57,70,.12); color:#e63946">📝</div>
                                <div class="activity-text">
                                    <div class="title">Blog post "UFC Training" updated</div>
                                    <div class="time">1 hour ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot" style="background:rgba(245,158,11,.12); color:#f59e0b">⚡</div>
                                <div class="activity-text">
                                    <div class="title">Swimming Pool price updated</div>
                                    <div class="time">3 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot" style="background:rgba(139,92,246,.12); color:#8b5cf6">👤</div>
                                <div class="activity-text">
                                    <div class="title">Admin logged in from new device</div>
                                    <div class="time">Today, 6:00 AM</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ===== MEMBERS SECTION ===== -->
            <div class="section" id="section-members">
                <div class="panel">
                    <div class="panel-header">
                        <div>
                            <h3>All Members</h3>
                            <div class="sub">128 total registered members</div>
                        </div>
                        <div style="display:flex; gap:10px; align-items:center;">
                            <div class="table-search">
                                <span>🔍</span>
                                <input type="text" placeholder="Search members…" id="memberSearch" oninput="filterMembers()">
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="data-table" id="membersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Member</th>
                                    <th>Phone</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Joined</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="membersBody">
                                <!-- Rows injected by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===== SERVICES SECTION ===== -->
            <div class="section" id="section-services">
                <div class="panel">
                    <div class="panel-header">
                        <div>
                            <h3>Gym Services</h3>
                            <div class="sub">5 active services</div>
                        </div>
                        <button class="btn btn-primary btn-sm" onclick="alert('Add Service feature — connect to database to enable!')">➕ Add Service</button>
                    </div>
                    <div class="services-grid">

                        <div class="service-card">
                            <div class="service-card-header">
                                <div class="service-icon">🏃</div>
                            </div>
                            <h4>Personal Training</h4>
                            <p>One-on-one training sessions with certified coaches tailored to your fitness goals.</p>
                            <div class="service-price">$60 / hour</div>
                            <div class="service-actions">
                                <button class="btn btn-info btn-sm" onclick="alert('Edit: Personal Training')">✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('Personal Training')">🗑️ Delete</button>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-card-header">
                                <div class="service-icon">🧘</div>
                            </div>
                            <h4>Group Classes</h4>
                            <p>Yoga, Pilates, Zumba, Spinning and more. Fun group settings for all fitness levels.</p>
                            <div class="service-price">$15 / class</div>
                            <div class="service-actions">
                                <button class="btn btn-info btn-sm" onclick="alert('Edit: Group Classes')">✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('Group Classes')">🗑️ Delete</button>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-card-header">
                                <div class="service-icon">🏋️</div>
                            </div>
                            <h4>Weight Training</h4>
                            <p>Full access to our weight room with premium equipment and guided programs.</p>
                            <div class="service-price">Included in membership</div>
                            <div class="service-actions">
                                <button class="btn btn-info btn-sm" onclick="alert('Edit: Weight Training')">✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('Weight Training')">🗑️ Delete</button>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-card-header">
                                <div class="service-icon">🚴</div>
                            </div>
                            <h4>Cardio Area</h4>
                            <p>Treadmills, bikes, elliptical machines and more cutting-edge cardio equipment.</p>
                            <div class="service-price">Included in membership</div>
                            <div class="service-actions">
                                <button class="btn btn-info btn-sm" onclick="alert('Edit: Cardio Area')">✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('Cardio Area')">🗑️ Delete</button>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-card-header">
                                <div class="service-icon">🏊</div>
                            </div>
                            <h4>Swimming Pool</h4>
                            <p>25-meter indoor heated pool with dedicated lanes for lap swimming and aqua classes.</p>
                            <div class="service-price">Included in membership</div>
                            <div class="service-actions">
                                <button class="btn btn-info btn-sm" onclick="alert('Edit: Swimming Pool')">✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('Swimming Pool')">🗑️ Delete</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ===== BLOG SECTION ===== -->
            <div class="section" id="section-blog">
                <div class="panel">
                    <div class="panel-header">
                        <div>
                            <h3>Blog Posts</h3>
                            <div class="sub">3 published posts</div>
                        </div>
                        <button class="btn btn-primary btn-sm" onclick="alert('Add Blog Post — connect to database to enable!')">➕ New Post</button>
                    </div>
                    <div class="blog-grid">

                        <div class="blog-card">
                            <img class="blog-card-img" src="images/khabib.webp" alt="UFC Training" onerror="this.style.background='linear-gradient(135deg,#1a1a3e,#e63946)'; this.style.height='160px'">
                            <div class="blog-card-body">
                                <span class="blog-category">Khabib</span>
                                <h4>New UFC Training Is Also In Our Gym</h4>
                                <p>Experience the legendary UFC training methodology. Our certified trainers bring world-class MMA techniques to your workout routine.</p>
                                <div class="blog-actions">
                                    <button class="btn btn-info btn-sm" onclick="alert('Edit Blog Post')">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete('UFC Training post')">🗑️ Delete</button>
                                    <button class="btn btn-success btn-sm" onclick="window.open('Page2.php')">👁️ View</button>
                                </div>
                            </div>
                        </div>

                        <div class="blog-card">
                            <img class="blog-card-img" src="images/yoga room.webp" alt="Yoga Room" onerror="this.style.background='linear-gradient(135deg,#10b981,#1a1a3e)'; this.style.height='160px'">
                            <div class="blog-card-body">
                                <span class="blog-category">Yoga</span>
                                <h4>Beautiful Yoga Room Is In Our Gym</h4>
                                <p>Discover our newly designed yoga studio featuring natural light, premium mats, and tranquil ambiance for your daily practice.</p>
                                <div class="blog-actions">
                                    <button class="btn btn-info btn-sm" onclick="alert('Edit Blog Post')">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete('Yoga Room post')">🗑️ Delete</button>
                                    <button class="btn btn-success btn-sm" onclick="window.open('Page2.php')">👁️ View</button>
                                </div>
                            </div>
                        </div>

                        <div class="blog-card">
                            <img class="blog-card-img" src="images/ground.avif" alt="Running Ground" onerror="this.style.background='linear-gradient(135deg,#3b82f6,#1a1a3e)'; this.style.height='160px'">
                            <div class="blog-card-body">
                                <span class="blog-category">Ground</span>
                                <h4>Just New Ground Added For Running</h4>
                                <p>We've added a brand-new outdoor running track to complement your cardio training. Perfect for sprints, laps, and group runs.</p>
                                <div class="blog-actions">
                                    <button class="btn btn-info btn-sm" onclick="alert('Edit Blog Post')">✏️ Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete('Running Ground post')">🗑️ Delete</button>
                                    <button class="btn btn-success btn-sm" onclick="window.open('Page2.php')">👁️ View</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ===== MESSAGES SECTION ===== -->
            <div class="section" id="section-messages">
                <div class="panel">
                    <div class="panel-header">
                        <div>
                            <h3>Contact Messages</h3>
                            <div class="sub">14 total — 4 unread</div>
                        </div>
                        <div style="display:flex; gap:8px;">
                            <button class="btn btn-outline btn-sm" onclick="markAllRead()">✅ Mark All Read</button>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sender</th>
                                    <th>Subject</th>
                                    <th>Preview</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="messagesBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div><!-- end page-content -->
    </div><!-- end main-content -->
</div><!-- end admin-wrapper -->

<script>
// ============================================================
//  SECTION NAVIGATION
// ============================================================
const sectionMeta = {
    dashboard: { title: 'Dashboard',   breadcrumb: 'Overview' },
    members:   { title: 'Members',     breadcrumb: 'All Members' },
    services:  { title: 'Services',    breadcrumb: 'Manage Services' },
    blog:      { title: 'Blog Posts',  breadcrumb: 'Manage Blog' },
    messages:  { title: 'Messages',    breadcrumb: 'Contact Messages' },
};

function showSection(name, navEl) {
    // Hide all sections
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    // Deactivate all nav items
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    // Show target
    document.getElementById('section-' + name).classList.add('active');
    if (navEl) navEl.classList.add('active');
    // Update topbar
    const meta = sectionMeta[name];
    document.getElementById('pageTitle').textContent       = meta.title;
    document.getElementById('breadcrumbSub').textContent   = meta.breadcrumb;
}

function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}

// ============================================================
//  COUNTER ANIMATION
// ============================================================
function animateCounter(id, target, duration) {
    const el = document.getElementById(id);
    let start = 0;
    const step = target / (duration / 16);
    const timer = setInterval(() => {
        start += step;
        if (start >= target) { start = target; clearInterval(timer); }
        el.textContent = Math.floor(start);
    }, 16);
}

// Run immediately — no DOMContentLoaded to avoid flicker
animateCounter('counter-members',  128, 1200);
animateCounter('counter-services',   5,  800);
animateCounter('counter-blog',       3,  600);
animateCounter('counter-messages',  14, 1000);
renderMembers();
renderMessages();

// ============================================================
//  MEMBERS DATA
// ============================================================
const membersData = [
    { name: 'Rahul Sharma',   email: 'rahul@gmail.com',   phone: '9876543210', age: 25, gender: 'Male',   joined: '01 Mar 2026', status: 'active',   color: '#e63946' },
    { name: 'Priya Patel',    email: 'priya@gmail.com',   phone: '9123456789', age: 22, gender: 'Female', joined: '28 Feb 2026', status: 'active',   color: '#3b82f6' },
    { name: 'Arjun Mehta',    email: 'arjun@gmail.com',   phone: '9988776655', age: 30, gender: 'Male',   joined: '25 Feb 2026', status: 'pending',  color: '#10b981' },
    { name: 'Sara Khan',      email: 'sara@gmail.com',    phone: '9564738291', age: 27, gender: 'Female', joined: '20 Feb 2026', status: 'active',   color: '#f59e0b' },
    { name: 'Vijay Singh',    email: 'vijay@gmail.com',   phone: '9012345678', age: 35, gender: 'Male',   joined: '15 Feb 2026', status: 'inactive', color: '#8b5cf6' },
    { name: 'Neha Joshi',     email: 'neha@gmail.com',    phone: '8765432109', age: 24, gender: 'Female', joined: '10 Feb 2026', status: 'active',   color: '#06b6d4' },
    { name: 'Kiran Rao',      email: 'kiran@gmail.com',   phone: '7654321098', age: 29, gender: 'Male',   joined: '05 Feb 2026', status: 'active',   color: '#84cc16' },
    { name: 'Divya Menon',    email: 'divya@gmail.com',   phone: '6543210987', age: 21, gender: 'Female', joined: '01 Feb 2026', status: 'pending',  color: '#ec4899' },
    { name: 'Rohan Gupta',    email: 'rohan@gmail.com',   phone: '9871234560', age: 33, gender: 'Male',   joined: '28 Jan 2026', status: 'active',   color: '#f97316' },
    { name: 'Anjali Desai',   email: 'anjali@gmail.com',  phone: '9012378456', age: 26, gender: 'Female', joined: '20 Jan 2026', status: 'inactive', color: '#a855f7' },
];

function renderMembers(filter = '') {
    const tbody = document.getElementById('membersBody');
    const filtered = membersData.filter(m =>
        m.name.toLowerCase().includes(filter.toLowerCase()) ||
        m.email.toLowerCase().includes(filter.toLowerCase()) ||
        m.gender.toLowerCase().includes(filter.toLowerCase())
    );
    tbody.innerHTML = filtered.map((m, i) => `
        <tr>
            <td style="color:var(--text-muted);font-size:.82rem;">${i + 1}</td>
            <td>
                <div class="member-cell">
                    <div class="member-avatar" style="background:${m.color}">${m.name[0]}</div>
                    <div>
                        <div class="member-name">${m.name}</div>
                        <div class="member-email">${m.email}</div>
                    </div>
                </div>
            </td>
            <td>${m.phone}</td>
            <td>${m.age}</td>
            <td>${m.gender}</td>
            <td style="font-size:.83rem;color:var(--text-muted)">${m.joined}</td>
            <td><span class="status-badge ${m.status}"><span class="status-dot"></span>${capitalize(m.status)}</span></td>
            <td>
                <div style="display:flex;gap:6px;">
                    <button class="btn btn-info btn-sm" onclick="alert('View member: ${m.name}')">👁️</button>
                    <button class="btn btn-success btn-sm" onclick="alert('Edit member: ${m.name}')">✏️</button>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete('${m.name}')">🗑️</button>
                </div>
            </td>
        </tr>
    `).join('');
}

function filterMembers() {
    renderMembers(document.getElementById('memberSearch').value);
}

// ============================================================
//  MESSAGES DATA
// ============================================================
const messagesData = [
    { sender: 'Amit Verma',    email: 'amit@gmail.com',   subject: 'Membership Enquiry',    preview: 'Hi, I wanted to know about monthly plans…',       date: '02 Mar 2026', status: 'unread' },
    { sender: 'Meena Shah',    email: 'meena@gmail.com',  subject: 'Personal Training',      preview: 'Can I book a session with a trainer this week?',   date: '02 Mar 2026', status: 'unread' },
    { sender: 'Sanjay Kumar',  email: 'sanjay@gmail.com', subject: 'Pool Timings',           preview: 'What are the swimming pool hours on weekends?',     date: '01 Mar 2026', status: 'read'   },
    { sender: 'Riya Bose',     email: 'riya@gmail.com',   subject: 'Yoga Class Schedule',   preview: 'Please share the updated yoga schedule for March.', date: '01 Mar 2026', status: 'unread' },
    { sender: 'Tarun Das',     email: 'tarun@gmail.com',  subject: 'Feedback — Great Gym!', preview: 'Just wanted to say the new running track is amazing!', date: '28 Feb 2026', status: 'read' },
    { sender: 'Pooja Nair',    email: 'pooja@gmail.com',  subject: 'Annual Membership',      preview: 'Is there any discount on the annual membership?',   date: '27 Feb 2026', status: 'unread' },
    { sender: 'Deepak Tiwari', email: 'deepak@gmail.com', subject: 'Group Classes',          preview: 'How many people are in each group Zumba class?',   date: '25 Feb 2026', status: 'read'   },
];

function renderMessages() {
    const tbody = document.getElementById('messagesBody');
    tbody.innerHTML = messagesData.map((m, i) => `
        <tr style="${m.status === 'unread' ? 'font-weight:600;' : ''}">
            <td style="color:var(--text-muted);font-size:.82rem;">${i + 1}</td>
            <td>
                <div class="msg-meta">${m.sender}</div>
                <div style="font-size:.75rem;color:var(--text-muted)">${m.email}</div>
            </td>
            <td class="msg-subject">${m.subject}</td>
            <td class="msg-preview" style="max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${m.preview}</td>
            <td style="font-size:.8rem;color:var(--text-muted);white-space:nowrap">${m.date}</td>
            <td><span class="status-badge ${m.status}"><span class="status-dot"></span>${capitalize(m.status)}</span></td>
            <td>
                <div style="display:flex;gap:6px;">
                    <button class="btn btn-info btn-sm" onclick="viewMessage(${i})">👁️ View</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteMessage(${i})">🗑️</button>
                </div>
            </td>
        </tr>
    `).join('');
}

function viewMessage(i) {
    const m = messagesData[i];
    alert(`📧 Message from ${m.sender}\nEmail: ${m.email}\nSubject: ${m.subject}\n\n"${m.preview}"\n\nDate: ${m.date}`);
    messagesData[i].status = 'read';
    renderMessages();
}

function deleteMessage(i) {
    if (confirm('Delete this message?')) {
        messagesData.splice(i, 1);
        renderMessages();
    }
}

function markAllRead() {
    messagesData.forEach(m => m.status = 'read');
    renderMessages();
    alert('All messages marked as read!');
}

// ============================================================
//  HELPERS
// ============================================================
function capitalize(s) { return s.charAt(0).toUpperCase() + s.slice(1); }

function confirmDelete(name) {
    if (confirm(`Are you sure you want to delete "${name}"?`)) {
        alert(`"${name}" has been deleted.`);
    }
}

function doLogout() {
    if (confirm('Are you sure you want to logout?')) {
        window.location.href = 'admin_logout.php';
    }
}
</script>

</body>
</html>
