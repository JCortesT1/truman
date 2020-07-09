function formatMoney(amount) {
    if (amount.toString().length > 3) {
        return (amount / 1000).toFixed(3);
    } else {
        return amount;
    }
}
