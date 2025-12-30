document.addEventListener("DOMContentLoaded", () => {

    // Cache DOM elements
    const publishedEl = document.getElementById("published-articles");
    const viewsEl = document.getElementById("total-views");
    const usersEl = document.getElementById("total-users");
    const commentsEl = document.getElementById("total-comments");
    const newCommentsEl = document.getElementById("new-comments");
    const growthEl = document.getElementById("percentage_growth");
    const latestArticlesEl = document.getElementById("latest-articles");
    const recentActivityEl = document.getElementById("recent-activity");

    // Date formatter
    const dateFormatter = new Intl.DateTimeFormat("fr-FR", {
        day: "numeric",
        month: "short",
        year: "numeric",
    });

    // Article status mapping
    const statusMap = {
        draft: {
            label: "Brouillon",
            bg: "bg-gray-100 text-gray-600",
            dot: "bg-gray-500",
            icon: "file-text",
            iconBg: "bg-gray-100 text-gray-500",
        },
        published: {
            label: "Publié",
            bg: "bg-emerald-50 text-emerald-600",
            dot: "bg-emerald-600",
            icon: "rocket",
            iconBg: "bg-emerald-100 text-emerald-600",
        },
        archived: {
            label: "Archivé",
            bg: "bg-red-50 text-red-600",
            dot: "bg-red-600",
            icon: "archive",
            iconBg: "bg-red-100 text-red-600",
        },
    };

    // Render helpers
    function renderArticleRow(article) {
        const status = statusMap[article.status] || statusMap.draft;
        const date = dateFormatter.format(new Date(article.created_at));
        return `
            <tr class="group hover:bg-white/50 transition-colors rounded-lg">
                <td class="px-4 py-3 whitespace-nowrap">
                    <div class="flex items-center gap-x-3">
                        <div class="flex-shrink-0 w-9 h-9 rounded-xl ${status.iconBg
            } flex items-center justify-center">
                            <i data-lucide="${status.icon}" class="w-5 h-5"></i>
                        </div>
                        <div class="grow">
                            <span class="block text-sm font-semibold text-gray-800">${article.title
            }</span>
                            <span class="block text-xs text-gray-500">Par ${article.user?.name ?? "Anonyme"
            }</span>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                    <span class="text-xs text-gray-500">${date}</span>
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-end">
                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium ${status.bg
            }">
                        <span class="w-1.5 h-1.5 inline-block rounded-full ${status.dot
            }"></span>
                        ${status.label}
                    </span>
                </td>
            </tr>
        `;
    }

    function renderActivityItem(activity) {
        const icon =
            activity.type === "article" ? "file-plus" : "message-circle";
        const color = activity.type === "article" ? "blue" : "green";
        const dotColor =
            activity.type === "article" ? "bg-blue-400" : "bg-green-400";

        return `
            <div class="flex gap-x-3 mb-4">
                <div class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200">
                    <div class="relative z-10 w-7 h-7 flex justify-center items-center">
                        <div class="w-2 h-2 rounded-full ${dotColor}"></div>
                    </div>
                </div>
                <div class="grow pt-0.5 pb-8">
                    <h3 class="flex gap-x-1.5 font-semibold text-gray-800">
                        <i data-lucide="${icon}" class="w-4 h-4 text-${color}-600 mt-1"></i> ${activity.title}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 break-all">${activity.message}</p>
                    <span class="text-xs text-gray-500">${activity.time}</span>
                </div>
            </div>
        `;
    }

    // Fetch and update dashboard
    async function loadDashboardStats() {
        try {
            const res = await fetch("/admin/dashboard/stats");
            const data = await res.json();

            console.log("Dashboard stats:", data);


            if (publishedEl) publishedEl.innerText = data.publishedArticles ?? 0;
            if (viewsEl) viewsEl.innerText = data.totalViews ?? 0;
            if (usersEl) usersEl.innerText = data.totalUsers ?? 0;
            if (commentsEl) commentsEl.innerText = data.totalComments ?? 0;
            if (newCommentsEl) newCommentsEl.innerText = (data.newComments ?? 0) + " nouveaux";

            if (growthEl && data.percentage_growth !== undefined) {
                const growth = data.percentage_growth;
                growthEl.innerText = (growth > 0 ? "+" : "") + growth + "%";
                growthEl.classList.toggle("text-green-600", growth >= 0);
                growthEl.classList.toggle("text-red-600", growth < 0);
            }

            // Latest articles
            if (latestArticlesEl && data.latestArticles) {
                latestArticlesEl.innerHTML = data.latestArticles
                    .map(renderArticleRow)
                    .join("");
            }

            // Recent activity
            if (recentActivityEl && data.recentActivity) {
                // Sort by ISO datetime if provided
                data.recentActivity.sort(
                    (a, b) => new Date(b.created_at) - new Date(a.created_at)
                );
                recentActivityEl.innerHTML = data.recentActivity
                    .map(renderActivityItem)
                    .join("");
            }
            window.createLucideIcons();
            console.log(window.createIcons);

        } catch (err) {
            console.error("Erreur dashboard:", err);
        }
    }

    // Load immediately and then auto-refresh every 60s
    loadDashboardStats();
    setInterval(loadDashboardStats, 60000);
});
