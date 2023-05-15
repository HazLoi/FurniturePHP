<?php
// Kết nối đến cơ sở dữ liệu
$connect = new Connect();

// Xử lý form khi được gửi lên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy năm từ form
    $year = $_POST['year'];

    // Lấy dữ liệu doanh thu theo tháng trong năm
    $revenues = $connect->getList("SELECT MONTH(ngay) AS thang, SUM(tongtien) AS doanhthu FROM hoa_don WHERE YEAR(ngay) = $year GROUP BY MONTH(ngay)");

    // Chuẩn bị dữ liệu cho biểu đồ
    $labels = array();
    $values = array();

    foreach ($revenues as $revenue) {
        $labels[] = "Tháng " . $revenue['thang'];
        $values[] = $revenue['doanhthu'];
    }
}
?>

<!-- Form nhập năm -->
<form class="" method="post">
    <label for="year">Nhập năm:</label>
    <input class="" type="number" id="year" name="year" required>
    <button class="btn btn-success" type="submit">Hiển thị</button>
</form>

<?php
// Kiểm tra nếu có dữ liệu doanh thu được lấy từ form
if (isset($revenues)) {
    // Hiển thị biểu đồ hình tròn
    echo "<div class='row'>";
    echo "<div class='col-lg-6 col-md-12     col-sm-12' id='chartContainer' style='width: 900px; height: 800px; position: relative; margin: 0 auto;'>";
    echo "<canvas id='revenueChart'></canvas>";
    echo "</div>";
    echo "</div>";
    echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
    echo "<script src='https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels'></script>";
    echo "<script>
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: " . json_encode($labels) . ",
                datasets: [{
                    data: " . json_encode($values) . ",
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#8e5ea2',
                        '#3cba9f',
                        '#e8c3b9',
                        '#c45850'
                    ],
                }],
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Thống kê doanh thu theo tháng trong năm $year',
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    datalabels: {
                        color: '#fff',
                        anchor: 'end',
                        align: 'start',
                        font: {
                            weight: 'bold',
                            size: '14'
                        },
                        formatter: function(value, context) {
                            return context.chart.data.labels[context.dataIndex] + ': ' + value;
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 20,
                        bottom: 20,
                        left: 20,
                        right: 120,
                    },
                },
                elements: {
                    arc: {
                        borderWidth: 0,
                    },
                },
            },
        });
    </script>";
}
?>
