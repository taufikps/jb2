    </div>
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('page-loading-overlay');
    const shell = document.querySelector('.page-shell');

    const isInternalLink = function (link) {
        if (!link || !link.getAttribute('href')) return false;
        if (link.target === '_blank' || link.hasAttribute('download')) return false;
        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:') || href.startsWith('javascript:')) {
            return false;
        }
        try {
            const url = new URL(href, window.location.href);
            return url.origin === window.location.origin;
        } catch (e) {
            return false;
        }
    };

    const showLoading = function () {
        if (overlay) overlay.classList.add('show');
        if (shell) shell.style.opacity = '0.9';
    };

    const hideLoading = function () {
        if (overlay) overlay.classList.remove('show');
        if (shell) shell.style.opacity = '1';
    };

    const contentArea = document.querySelector('.content-area');

    const normalizePath = function (pathname) {
        if (!pathname) return '/';
        let path = pathname.toString();
        const indexPos = path.indexOf('/index.php');
        if (indexPos !== -1) {
            path = path.slice(indexPos + '/index.php'.length);
        }
        if (!path.startsWith('/')) {
            path = '/' + path;
        }
        path = path.replace(/\/\/+/, '/');
        if (path.length > 1 && path.endsWith('/')) {
            path = path.slice(0, -1);
        }
        return path;
    };

    const shouldAjaxNavigate = function (link) {
        if (!link || !isInternalLink(link)) return false;
        if (link.target === '_blank') return false;
        if (link.hasAttribute('download')) return false;
        if (link.hasAttribute('data-no-ajax')) return false;
        const href = link.getAttribute('href');
        if (!href) return false;
        try {
            const url = new URL(href, window.location.href);
            const pathname = normalizePath(url.pathname);
            return pathname.includes('/admin') && !pathname.includes('/admin/logs/view') && !pathname.includes('/admin/d365-config');
        } catch (e) {
            return false;
        }
    };

    const updateActiveSidebar = function () {
        const currentPath = normalizePath(window.location.pathname);
        document.querySelectorAll('.sidebar a').forEach(function (link) {
            const href = link.getAttribute('href');
            if (!href) return;
            try {
                const url = new URL(href, window.location.href);
                const linkPath = normalizePath(url.pathname);
                const isActive = currentPath === linkPath || currentPath.startsWith(linkPath + '/');
                link.classList.toggle('active', isActive);
            } catch (e) {
                link.classList.remove('active');
            }
        });
    };

    updateActiveSidebar();

    const enhanceSection = function (root) {
        root = root || document;
        root.querySelectorAll('.table-filter-card').forEach(function (card) {
            if (card.dataset.enhanced === '1') return;
            card.dataset.enhanced = '1';

            const searchInput = card.querySelector('.table-filter-search');
            const statusSelect = card.querySelector('.table-filter-status');
            const resetButton = card.querySelector('.table-filter-reset');
            const table = card.querySelector('.table-filter-table');

            if (!table || !searchInput || !statusSelect) return;

            const applyFilter = function () {
                const query = (searchInput.value || '').toLowerCase().trim();
                const status = (statusSelect.value || '').toLowerCase();
                const rows = table.querySelectorAll('tbody tr');

                rows.forEach(function (row) {
                    const text = row.textContent.toLowerCase();
                    const rowStatus = (row.getAttribute('data-status') || '').toLowerCase();
                    const matchesQuery = !query || text.includes(query);
                    const matchesStatus = !status || rowStatus === status;
                    row.classList.toggle('hidden', !(matchesQuery && matchesStatus));
                });
            };

            searchInput.addEventListener('input', applyFilter);
            statusSelect.addEventListener('change', applyFilter);
            if (resetButton) {
                resetButton.addEventListener('click', function () {
                    searchInput.value = '';
                    statusSelect.value = '';
                    applyFilter();
                });
            }
        });

        const refreshBtn = root.querySelector('#penjualan-refresh-btn');
        const realtimeToggle = root.querySelector('#penjualan-realtime-toggle');

        if (refreshBtn && refreshBtn.dataset.enhanced !== '1') {
            refreshBtn.dataset.enhanced = '1';
            refreshBtn.addEventListener('click', function () {
                refreshPenjualanRows();
            });
        }

        if (realtimeToggle && realtimeToggle.dataset.enhanced !== '1') {
            realtimeToggle.dataset.enhanced = '1';
            realtimeToggle.addEventListener('change', function () {
                if (realtimeToggle.checked) {
                    startRealtime();
                } else {
                    stopRealtime();
                }
            });
        }
    };

    const animateAdminContent = function () {
        if (!contentArea) return;
        contentArea.classList.remove('swap-animate');
        void contentArea.offsetWidth;
        contentArea.classList.add('swap-animate');
        window.setTimeout(function () {
            contentArea.classList.remove('swap-animate');
        }, 400);
    };

    const ajaxNavigate = function (url, replaceState) {
        if (!contentArea) {
            window.location.href = url.toString();
            return;
        }

        showLoading();
        fetch(url.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function (response) {
            if (!response.ok) {
                throw new Error('Gagal memuat halaman');
            }
            return response.text();
        }).then(function (html) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.querySelector('.content-area');
            if (!newContent) {
                window.location.href = url.toString();
                return;
            }
            contentArea.innerHTML = newContent.innerHTML;
            animateAdminContent();
            document.title = doc.title || document.title;
            enhanceSection(contentArea);
            if (replaceState) {
                window.history.replaceState({ url: url.toString() }, '', url.toString());
            } else {
                window.history.pushState({ url: url.toString() }, '', url.toString());
            }
            updateActiveSidebar();
        }).catch(function (err) {
            console.error(err);
            window.location.href = url.toString();
        }).finally(function () {
            hideLoading();
        });
    };

    document.addEventListener('click', function (event) {
        const link = event.target.closest('a[href]');
        if (!link) return;
        if (!shouldAjaxNavigate(link)) return;
        event.preventDefault();
        const url = new URL(link.getAttribute('href'), window.location.href);
        ajaxNavigate(url);
    });

    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (form.tagName !== 'FORM') return;
        if (form.getAttribute('target') === '_blank') return;
        showLoading();
    });

    window.addEventListener('popstate', function (event) {
        const stateUrl = event.state && event.state.url ? event.state.url : window.location.href;
        ajaxNavigate(new URL(stateUrl, window.location.href), true);
    });

    enhanceSection(document);
    updateActiveSidebar();
    window.addEventListener('load', hideLoading);
    window.addEventListener('pageshow', hideLoading);

    // Admin penjualan refresh / realtime support
    const penjualanRefreshBtn = document.getElementById('penjualan-refresh-btn');
    const penjualanRealtimeToggle = document.getElementById('penjualan-realtime-toggle');
    const penjualanRowsContainer = document.getElementById('penjualan-rows-container');
    let penjualanRealtimeTimer = null;

    const refreshPenjualanRows = function () {
        const url = new URL(window.location.href);
        url.pathname = url.pathname.replace(/\/admin\/penjualan.*/, '/admin/penjualan/ajax_rows');
        if (url.searchParams.has('page')) {
            url.searchParams.set('page', url.searchParams.get('page'));
        }

        fetch(url.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function (response) {
            if (!response.ok) {
                throw new Error('Gagal memuat data');
            }
            return response.text();
        }).then(function (html) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const rows = doc.querySelectorAll('#penjualan-rows-container tr');
            if (penjualanRowsContainer && rows.length) {
                penjualanRowsContainer.innerHTML = '';
                rows.forEach(r => penjualanRowsContainer.appendChild(r));
            }
        }).catch(function (err) {
            console.error(err);
        });
    };

    const startRealtime = function () {
        stopRealtime();
        penjualanRealtimeTimer = setInterval(refreshPenjualanRows, 5000);
    };

    const stopRealtime = function () {
        if (penjualanRealtimeTimer) clearInterval(penjualanRealtimeTimer);
        penjualanRealtimeTimer = null;
    };
});
</script>
</body>
</html>
