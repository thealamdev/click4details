function sendToWhatsApp(vehicleName, price, additional_price, fixed_pirce, brand, edition, engines, fuel, mileages, details, e) {
    e.preventDefault();
    const vehicleNameEncoded = encodeURIComponent("Vehicle Name: " + vehicleName);
    const brandEncoded = encodeURIComponent("Brand: " + brand);
    const editionEncoded = encodeURIComponent("Edition: " + edition);
    const engineEncoded = encodeURIComponent("Engines: " + engines);
    const fuelEncoded = encodeURIComponent("Fuel: " + fuel);
    const mileageEncoded = encodeURIComponent("Mileage: " + mileages);
    const productDetailsEncoded = encodeURIComponent("Click for Details: " + details);
    let finalPrice;

    if (Number(fixed_pirce) > 0) {
        finalPrice = Number(fixed_pirce) + Number(additional_price);
    } else {
        finalPrice = Number(price) + Number(additional_price);
    }
    const finalPriceEncode = encodeURIComponent('Final Price = ' + finalPrice)
    const whatsappLink =
        `https://wa.me/?text=${vehicleNameEncoded}%0A${brandEncoded}%0A${editionEncoded}%0A${engineEncoded}%0A${mileageEncoded}%0A${finalPriceEncode}%0A${fuelEncoded}%0A${productDetailsEncoded}`;
    window.open(whatsappLink, "_blank");
}