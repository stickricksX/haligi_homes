// Kunin yung id mula sa URL
const params = new URLSearchParams(window.location.search);
const id = params.get("id");

// Property data
const propertyData = {
  "1": {
    title: "Modern Home in Ayala Westgrove",
    price: "₱60M",
    beds: 4,
    baths: 3.5,
    area: "360 sqm",
    description: "Contemporary design with spacious interiors, open floor plan, and a large garden perfect for family gatherings.",
    images: ["../img/house1.jpg"]
  },
  "2": {
    title: "Elegant Villa in Tagaytay Highlands",
    price: "₱45M",
    beds: 3,
    baths: 3,
    area: "300 sqm",
    description: "Stunning villa with breathtaking views, premium finishes, and cozy fireplaces for a warm ambiance.",
    images: ["../img/house2.jpg"]
  },
  "3": {
    title: "Cozy Home in Laguna Bel-Air",
    price: "₱25M",
    beds: 3,
    baths: 2,
    area: "180 sqm",
    description: "Comfortable family home located in a quiet neighborhood, close to schools and parks.",
    images: ["../img/house3.jpg"]
  },
  "4": {
    title: "Luxury Mansion in Forbes Park",
    price: "₱80M",
    beds: 6,
    baths: 6,
    area: "800 sqm",
    description: "Exquisite mansion with a grand entrance, private pool, home theater, and state-of-the-art amenities.",
    images: ["../img/house4.jpg"]
  },
  "5": {
    title: "Family House in Dasmariñas Village",
    price: "₱18M",
    beds: 4,
    baths: 3,
    area: "250 sqm",
    description: "Warm and inviting family home with a spacious kitchen and nearby community parks.",
    images: ["../img/house5.jpg", "../img/house5a.jpg", "../img/house5b.jpg"]
  }
};

const prop = propertyData[id];

if (prop) {
  document.getElementById("title").textContent = prop.title;
  document.getElementById("price").textContent = prop.price;

  document.getElementById("bedbath").innerHTML = `
    <span><i class="fa-solid fa-bed"></i> ${prop.beds} Beds</span>
    <span><i class="fa-solid fa-bath"></i> ${prop.baths} Baths</span>
    <span><i class="fa-solid fa-ruler-combined"></i> ${prop.area}</span>
  `;

  document.getElementById("description").textContent = prop.description;

  const gallery = document.getElementById("gallery");
  prop.images.forEach(src => {
    const img = document.createElement("img");
    img.src = src;
    img.alt = prop.title;
    gallery.appendChild(img);
  });
} else {
  document.body.innerHTML = "<p>Property not found.</p><a href='../index.html'>← Back</a>";
}

// Modal functionality
document.addEventListener("DOMContentLoaded", () => {
  const openContactBtn = document.getElementById("openContactBtn");
  const contactModal = document.getElementById("contactModal");
  const closeContact = document.getElementById("closeContact");
  const propertyNameInput = document.getElementById("propertyName");
  const propertyTitle = document.getElementById("title").textContent;

  openContactBtn.addEventListener("click", () => {
    propertyNameInput.value = propertyTitle || "Property";
    contactModal.style.display = "flex";
  });

  closeContact.addEventListener("click", () => {
    contactModal.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target === contactModal) {
      contactModal.style.display = "none";
    }
  });

  const contactForm = document.getElementById("contactForm");
  contactForm.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Message sent! Thank you for contacting the agent.");
    contactForm.reset();
    contactModal.style.display = "none";
  });

  // At the bottom of property-details.js inside DOMContentLoaded

document.addEventListener("DOMContentLoaded", () => {
  const addToFavoritesBtn = document.getElementById("addToFavoritesBtn");

  if (addToFavoritesBtn && prop) {
    addToFavoritesBtn.addEventListener("click", () => {
      let favorites = JSON.parse(localStorage.getItem("favorites")) || [];

      const alreadyFavorite = favorites.some(item => item.id === id);

      if (!alreadyFavorite) {
        favorites.push({
          id: id,
          title: prop.title,
          price: prop.price,
          images: prop.images
        });

        localStorage.setItem("favorites", JSON.stringify(favorites));
        alert("Property added to favorites!");
      } else {
        alert("This property is already in your favorites.");
      }
    });
  }
});
});
