document.addEventListener('DOMContentLoaded', function () {
    if (window.createLucideIcons) {
        window.createLucideIcons();
    }

    const userId = window.authorUserId;

    if (!userId) {
        console.error('Author user ID not found');
        return;
    }

    fetchAuthorStats(userId);
});

async function fetchAuthorStats(userId) {
    try {
        const response = await fetch(`/author/dashboard/${userId}/stats`);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        updateStats(data);
        updateActivity(data.myRecentActivity);

    } catch (error) {
        console.error('Error fetching author stats:', error);
        showError();
    }
}

function updateStats(data) {
    const articlesElement = document.getElementById('my-articles-count');
    if (articlesElement) {
        articlesElement.textContent = data.myArticles || 0;
    }

    const viewsElement = document.getElementById('my-total-views');
    if (viewsElement) {
        viewsElement.textContent = data.myTotalViews || 0;
    }
}

function updateActivity(activities) {
    const container = document.getElementById('activity-container');

    if (!container) {
        return;
    }

    if (!activities || activities.length === 0) {
        container.innerHTML = `
            <div class="text-center py-8">
                <p class="text-gray-500">Aucune activité récente</p>
            </div>
        `;
        return;
    }

    let html = '';

    activities.forEach((activity, index) => {
        const isLast = index === activities.length - 1;
        const colorClass = activity.color === 'blue' ? 'bg-blue-400' : 'bg-green-400';
        const iconColorClass = activity.color === 'blue' ? 'text-blue-600' : 'text-green-600';

        html += `
            <div class="flex gap-x-3 ${!isLast ? 'mb-4' : ''}">
                <div class="relative ${!isLast ? 'after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200' : ''}">
                    <div class="relative z-10 w-7 h-7 flex justify-center items-center">
                        <div class="w-2 h-2 rounded-full ${colorClass}"></div>
                    </div>
                </div>
                <div class="grow pt-0.5 ${!isLast ? 'pb-8' : 'pb-0'}">
                    <h3 class="flex gap-x-1.5 font-semibold text-gray-800">
                        <i data-lucide="${activity.icon}" class="w-4 h-4 ${iconColorClass} mt-1"></i>
                        ${activity.title}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">${activity.message}</p>
                    <span class="text-xs text-gray-500">${activity.time}</span>
                </div>
            </div>
        `;
    });

    container.innerHTML = html;

    if (window.createLucideIcons) {
        window.createLucideIcons();
    }
}

function showError() {
    const articlesElement = document.getElementById('my-articles-count');
    const viewsElement = document.getElementById('my-total-views');
    const activityContainer = document.getElementById('activity-container');

    if (articlesElement) {
        articlesElement.innerHTML = '<span class="text-red-500">Erreur</span>';
    }
    if (viewsElement) {
        viewsElement.innerHTML = '<span class="text-red-500">Erreur</span>';
    }
    if (activityContainer) {
        activityContainer.innerHTML = `
            <div class="text-center py-8">
                <p class="text-red-500">Erreur lors du chargement des données</p>
            </div>
        `;
    }
}
