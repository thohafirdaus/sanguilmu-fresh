(function () {
	const toggle = document.querySelector('.si-menu-toggle');
	const nav = document.querySelector('.si-nav');

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			const isOpen = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});
	}

	const searchButton = document.querySelector('.si-search-link');
	const searchModal = document.querySelector('.si-search-modal');
	const searchField = document.querySelector('.si-modal-search-field');
	const searchCloseItems = document.querySelectorAll('[data-search-close]');

	function openSearchModal() {
		if (!searchModal || !searchButton) {
			return;
		}

		searchModal.classList.add('is-open');
		searchModal.setAttribute('aria-hidden', 'false');
		searchButton.setAttribute('aria-expanded', 'true');
		document.documentElement.classList.add('si-modal-active');

		window.setTimeout(function () {
			if (searchField) {
				searchField.focus();
			}
		}, 80);
	}

	function closeSearchModal() {
		if (!searchModal || !searchButton) {
			return;
		}

		searchModal.classList.remove('is-open');
		searchModal.setAttribute('aria-hidden', 'true');
		searchButton.setAttribute('aria-expanded', 'false');
		document.documentElement.classList.remove('si-modal-active');
		searchButton.focus();
	}

	if (searchButton && searchModal) {
		searchButton.addEventListener('click', openSearchModal);

		searchCloseItems.forEach(function (item) {
			item.addEventListener('click', closeSearchModal);
		});

		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape' && searchModal.classList.contains('is-open')) {
				closeSearchModal();
			}
		});
	}

	const mobileToc = document.querySelector('.si-mobile-toc');
	const mobileTocToggle = mobileToc ? mobileToc.querySelector('.si-mobile-toc-toggle') : null;
	const mobileTocPanel = mobileToc ? mobileToc.querySelector('.si-mobile-toc-panel') : null;
	const mobileTocCurrent = mobileToc ? mobileToc.querySelector('.si-mobile-toc-current') : null;
	const tocLinks = document.querySelectorAll('.si-toc-list a[href^="#"]');
	const tocTargets = [];

	function closeMobileToc() {
		if (!mobileToc) {
			return;
		}

		mobileToc.removeAttribute('open');
	}

	if (mobileTocToggle && mobileTocPanel) {
		mobileTocToggle.addEventListener('click', function (event) {
			event.preventDefault();
			event.stopPropagation();

			if (mobileToc.tagName.toLowerCase() === 'details') {
				mobileToc.toggleAttribute('open');
			} else {
				const isOpen = mobileTocToggle.getAttribute('aria-expanded') === 'true';

				mobileTocToggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
				mobileTocPanel.hidden = isOpen;
			}
		});

		mobileTocToggle.addEventListener('keydown', function (event) {
			if (event.key === 'Enter' || event.key === ' ') {
				event.stopPropagation();
			}
		});

		mobileTocPanel.addEventListener('click', function (event) {
			event.stopPropagation();
		});

		mobileTocPanel.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', closeMobileToc);
		});

		document.addEventListener('click', function (event) {
			if (!mobileToc.contains(event.target)) {
				closeMobileToc();
			}
		});
	}

	function getStickyOffset() {
		const header = document.querySelector('.si-site-header');
		const mobileTocHeight = mobileToc && window.getComputedStyle(mobileToc).display !== 'none' ? mobileToc.offsetHeight : 0;
		const adminBar = document.getElementById('wpadminbar');
		const headerHeight = header ? header.offsetHeight : 0;
		const adminBarHeight = adminBar && window.getComputedStyle(adminBar).position === 'fixed' ? adminBar.offsetHeight : 0;

		return headerHeight + mobileTocHeight + adminBarHeight + 18;
	}

	function setActiveToc(targetId) {
		let activeText = '';

		tocLinks.forEach(function (link) {
			const isActive = link.hash === '#' + targetId;

			link.classList.toggle('is-active', isActive);

			if (isActive) {
				activeText = link.textContent.trim();
			}
		});

		if (mobileTocCurrent && activeText) {
			mobileTocCurrent.textContent = activeText;
		}
	}

	tocLinks.forEach(function (link) {
		const targetId = decodeURIComponent(link.hash.slice(1));
		const target = targetId ? document.getElementById(targetId) : null;

		if (target) {
			tocTargets.push(target);
		}

		link.addEventListener('click', function (event) {
			if (!target) {
				return;
			}

			event.preventDefault();
			window.history.pushState(null, '', '#' + target.id);
			window.scrollTo({
				top: target.getBoundingClientRect().top + window.pageYOffset - getStickyOffset(),
				behavior: 'smooth'
			});
			setActiveToc(target.id);
			closeMobileToc();
		});
	});

	if ('IntersectionObserver' in window && tocTargets.length) {
		const tocObserver = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					setActiveToc(entry.target.id);
				}
			});
		}, {
			rootMargin: '-' + getStickyOffset() + 'px 0px -60% 0px',
			threshold: 0.01
		});

		tocTargets.forEach(function (target) {
			tocObserver.observe(target);
		});
	}

	const revealItems = document.querySelectorAll('.si-reveal');

	if ('IntersectionObserver' in window && revealItems.length) {
		const observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.16 });

		revealItems.forEach(function (item, index) {
			item.style.transitionDelay = Math.min(index * 70, 360) + 'ms';
			observer.observe(item);
		});
	} else {
		revealItems.forEach(function (item) {
			item.classList.add('is-visible');
		});
	}
}());
