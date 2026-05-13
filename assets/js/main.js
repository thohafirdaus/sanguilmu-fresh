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
