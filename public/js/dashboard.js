document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("users").textContent = 120;
  document.getElementById("orders").textContent = 85;
  document.getElementById("sales").textContent = "₱45,000";
  document.getElementById("pending").textContent = 12;
});

 new Chart(document.getElementById('salesChart'), {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Sales',
        data: [12000, 15000, 10000, 18000, 22000, 25000],
        borderColor: '#3498db',
        backgroundColor: 'rgba(52,152,219,0.2)',
        fill: true,
        tension: 0.4
      }]
    }
  });

  // Orders Status Chart
  new Chart(document.getElementById('ordersChart'), {
    type: 'doughnut',
    data: {
      labels: ['Completed', 'Pending', 'Cancelled'],
      datasets: [{
        data: [65, 20, 15],
        backgroundColor: ['#27ae60', '#f39c12', '#e74c3c']
      }]
    }
  });