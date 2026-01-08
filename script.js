// 👤 Account Dropdown Toggle
function toggleDropdown() {
  const dropdown = document.getElementById('accountDropdown');
  dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// 🔒 Close dropdown if clicked outside
window.addEventListener('click', function (e) {
  const icon = document.querySelector('.account-icon');
  const menu = document.getElementById('accountDropdown');
  if (!icon.contains(e.target) && !menu.contains(e.target)) {
    menu.style.display = 'none';
  }
});

// Modal close functions for inline onclick
function closeForm() {
  document.getElementById('contactModal').style.display = 'none';
}
function closeConfirmation() {
  document.getElementById('confirmationModal').style.display = 'none';
}

// Function to navigate to property details page
function viewProperty(card) {
  const id = card.dataset.id;
  if (id) {
    window.location.href = `properties/properties-details.html?id=${id}`;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  // =========================
  // 🏠 Property Card Click
  // =========================
  const propertyCards = document.querySelectorAll(".property-card");

  propertyCards.forEach((card) => {
    card.addEventListener("click", () => viewProperty(card));
  });

  // =========================
  // 🔍 Filtering
  // =========================
  const filters = {
    location: "all",
    bedrooms: "all",
    price: "all",
    bathrooms: "all",
  };

  const getFilterElement = (id) => document.getElementById(id);
  const locationFilter = getFilterElement("locationFilter");
  const bedroomFilter = getFilterElement("bedroomFilter");
  const priceFilter = getFilterElement("priceFilter");
  const bathroomFilter = getFilterElement("bathroomFilter");
  const resetBtn = getFilterElement("resetFiltersBtn");

  function applyFilters() {
    propertyCards.forEach((card) => {
      const cardLocation = card.dataset.location || "all";
      const cardBedrooms = card.dataset.bedrooms || "all";
      const cardBathrooms = card.dataset.bathrooms || "all";
      const cardPrice = parseInt(card.dataset.price, 10) || 0;

      const locationMatch = filters.location === "all" || filters.location === cardLocation;
      const bedroomsMatch = filters.bedrooms === "all" ||
        (filters.bedrooms === "5+" ? parseInt(cardBedrooms, 10) >= 5 : filters.bedrooms === cardBedrooms);
      const bathroomsMatch = filters.bathrooms === "all" ||
        (filters.bathrooms === "5+" ? parseInt(cardBathrooms, 10) >= 5 : filters.bathrooms === cardBathrooms);

      let priceMatch = false;
      switch (filters.price) {
        case "all": priceMatch = true; break;
        case "0-20": priceMatch = cardPrice <= 20; break;
        case "21-50": priceMatch = cardPrice >= 21 && cardPrice <= 50; break;
        case "51-100": priceMatch = cardPrice >= 51 && cardPrice <= 100; break;
      }

      card.style.display = (locationMatch && bedroomsMatch && bathroomsMatch && priceMatch) ? "flex" : "none";
    });
  }

  // Filter change events
  [
    { element: locationFilter, key: "location" },
    { element: bedroomFilter, key: "bedrooms" },
    { element: priceFilter, key: "price" },
    { element: bathroomFilter, key: "bathrooms" }
  ].forEach(({ element, key }) => {
    if (element) {
      element.addEventListener("change", () => {
        filters[key] = element.value;
        applyFilters();
      });
    }
  });

  if (resetBtn) {
    resetBtn.addEventListener("click", () => {
      Object.keys(filters).forEach((key) => filters[key] = "all");
      document.querySelectorAll(".sidebar select").forEach((el) => el.value = "all");
      applyFilters();
    });
  }

  // =========================
  // ⬅️➡️ Scroll Buttons
  // =========================
  const scrollLeftBtn = getFilterElement("scrollLeft");
  const scrollRightBtn = getFilterElement("scrollRight");
  const propertyList = getFilterElement("propertyList");

  if (scrollLeftBtn && scrollRightBtn && propertyList) {
    scrollLeftBtn.addEventListener("click", () => {
      propertyList.scrollBy({ left: -300, behavior: "smooth" });
    });
    scrollRightBtn.addEventListener("click", () => {
      propertyList.scrollBy({ left: 300, behavior: "smooth" });
    });
  }

  // =========================
  // 📩 Contact Modal
  // =========================
  const contactButtons = document.querySelectorAll(".contact-button");
  const contactModal = getFilterElement("contactModal");

  contactButtons.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.stopPropagation();  // Prevent card click navigation

      const card = btn.closest(".property-card");
      const propertyName = btn.getAttribute("onclick")?.match(/'(.*?)'/)?.[1] || "";
      const agentName = card?.dataset.agentName || "Agent";
      const agentNumber = card?.dataset.agentNumber || "N/A";
      const agentImg = card?.dataset.agentImg || "img/default-agent.jpg";

      // Fill contact form with data
      getFilterElement("property").value = propertyName;
      document.querySelector(".agent-name").innerHTML = `Hi <strong>${agentName}</strong>!`;
      document.querySelector(".agent-number").textContent = `📞 ${agentNumber}`;
      document.querySelector(".agent-img").src = agentImg;

      contactModal.style.display = "block";
    });
  });

  window.addEventListener("click", (e) => {
    if (e.target === contactModal) contactModal.style.display = "none";
  });

  // =========================
  // 🔽 Scroll to Properties
  // =========================
  const exploreBtn = getFilterElement("exploreBtn");
  const headerOffset = 10;

  exploreBtn?.addEventListener("click", function (e) {
    e.preventDefault();
    const target = getFilterElement("properties");
    const offsetTop = target.getBoundingClientRect().top + window.pageYOffset - headerOffset;
    window.scrollTo({ top: offsetTop, behavior: "smooth" });
  });

  // =========================
  // ✅ Contact Form Submit
  // =========================
  const confirmationModal = getFilterElement("confirmationModal");
  const contactForm = getFilterElement("contactForm");

  if (contactForm && contactModal && confirmationModal) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault(); // Stop form submit

      // Close contact modal and show confirmation modal
      contactModal.style.display = "none";
      confirmationModal.style.display = "block";

      // Clear form
      contactForm.reset();
    });

    // Close confirmation modal with × button
    const closeBtn = confirmationModal.querySelector(".close-btn");
    closeBtn?.addEventListener("click", () => {
      confirmationModal.style.display = "none";
    });

    // Close confirmation modal by clicking outside
    window.addEventListener("click", (e) => {
      if (e.target === confirmationModal) {
        confirmationModal.style.display = "none";
      }
    });
  }

   // =========================
  // ⭐ Favorite Button Click
  // =========================
  const favoriteButtons = document.querySelectorAll(".favorite-btn");

  favoriteButtons.forEach((btn) => {
    btn.addEventListener("click", (event) => {
      event.stopPropagation(); // Prevent triggering viewProperty

      const listing = btn.closest(".listing");

      if (listing) {
        const id = listing.dataset.id;
        const title = listing.dataset.title;
        const price = listing.dataset.price;
        const image = listing.dataset.image;

        const favorites = JSON.parse(localStorage.getItem("favorites")) || [];

        if (!favorites.some(item => item.id === id)) {
          favorites.push({ id, title, price, image });
          localStorage.setItem("favorites", JSON.stringify(favorites));
          alert("Added to Favorites!");
        } else {
          alert("Already in Favorites.");
        }
      }
    });
  });
});
