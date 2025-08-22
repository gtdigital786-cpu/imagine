<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Prepare arrays for plot shape and road direction
        $plot_shapes = isset($_POST['plot_shape']) ? implode(',', $_POST['plot_shape']) : '';
        $road_directions = isset($_POST['road_direction']) ? implode(',', $_POST['road_direction']) : '';
        
        $sql = "INSERT INTO house_plans (
            name, mobile, email, city, plot_shape, plot_length, plot_width, plot_radius,
            margin_right, margin_left, margin_back, margin_front, road_direction,
            front_facing, entry_gate, main_door,
            gf_parking, gf_porch, gf_hall, gf_duplex_hall, gf_kitchen, gf_washing,
            gf_store, gf_bedroom, gf_bedroom_balcony, gf_master_bedroom, gf_master_balcony,
            gf_toilet, gf_bathroom, gf_puja, gf_guest, gf_theater, gf_courtyard,
            gf_staircase, gf_staircase_hall,
            ff_parking, ff_porch, ff_hall, ff_duplex_hall, ff_kitchen, ff_washing,
            ff_store, ff_bedroom, ff_bedroom_balcony, ff_master_bedroom, ff_master_balcony,
            ff_toilet, ff_bathroom, ff_puja, ff_guest, ff_theater, ff_courtyard,
            ff_staircase, ff_staircase_hall,
            sf_parking, sf_porch, sf_hall, sf_duplex_hall, sf_kitchen, sf_washing,
            sf_store, sf_bedroom, sf_bedroom_balcony, sf_master_bedroom, sf_master_balcony,
            sf_toilet, sf_bathroom, sf_puja, sf_guest, sf_theater, sf_courtyard,
            sf_staircase, sf_staircase_hall,
            total_ground, total_first, total_second
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?
        )";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['name'], $_POST['mobile'], $_POST['email'], $_POST['city'],
            $plot_shapes, $_POST['plot_length'] ?? '', $_POST['plot_width'] ?? '',
            $_POST['plot_radius'] ?? '', $_POST['margin_right'] ?? '',
            $_POST['margin_left'] ?? '', $_POST['margin_back'] ?? '',
            $_POST['margin_front'] ?? '', $road_directions,
            $_POST['front_facing'] ?? '', $_POST['entry_gate'] ?? '',
            $_POST['main_door'] ?? '',
            // Ground floor
            $_POST['gf_parking'] ?? 0, $_POST['gf_porch'] ?? 0, $_POST['gf_hall'] ?? 0,
            $_POST['gf_duplex_hall'] ?? 0, $_POST['gf_kitchen'] ?? 0, $_POST['gf_washing'] ?? 0,
            $_POST['gf_store'] ?? 0, $_POST['gf_bedroom'] ?? 0, $_POST['gf_bedroom_balcony'] ?? 0,
            $_POST['gf_master_bedroom'] ?? 0, $_POST['gf_master_balcony'] ?? 0,
            $_POST['gf_toilet'] ?? 0, $_POST['gf_bathroom'] ?? 0, $_POST['gf_puja'] ?? 0,
            $_POST['gf_guest'] ?? 0, $_POST['gf_theater'] ?? 0, $_POST['gf_courtyard'] ?? 0,
            $_POST['gf_staircase'] ?? 0, $_POST['gf_staircase_hall'] ?? 0,
            // First floor
            $_POST['ff_parking'] ?? 0, $_POST['ff_porch'] ?? 0, $_POST['ff_hall'] ?? 0,
            $_POST['ff_duplex_hall'] ?? 0, $_POST['ff_kitchen'] ?? 0, $_POST['ff_washing'] ?? 0,
            $_POST['ff_store'] ?? 0, $_POST['ff_bedroom'] ?? 0, $_POST['ff_bedroom_balcony'] ?? 0,
            $_POST['ff_master_bedroom'] ?? 0, $_POST['ff_master_balcony'] ?? 0,
            $_POST['ff_toilet'] ?? 0, $_POST['ff_bathroom'] ?? 0, $_POST['ff_puja'] ?? 0,
            $_POST['ff_guest'] ?? 0, $_POST['ff_theater'] ?? 0, $_POST['ff_courtyard'] ?? 0,
            $_POST['ff_staircase'] ?? 0, $_POST['ff_staircase_hall'] ?? 0,
            // Second floor
            $_POST['sf_parking'] ?? 0, $_POST['sf_porch'] ?? 0, $_POST['sf_hall'] ?? 0,
            $_POST['sf_duplex_hall'] ?? 0, $_POST['sf_kitchen'] ?? 0, $_POST['sf_washing'] ?? 0,
            $_POST['sf_store'] ?? 0, $_POST['sf_bedroom'] ?? 0, $_POST['sf_bedroom_balcony'] ?? 0,
            $_POST['sf_master_bedroom'] ?? 0, $_POST['sf_master_balcony'] ?? 0,
            $_POST['sf_toilet'] ?? 0, $_POST['sf_bathroom'] ?? 0, $_POST['sf_puja'] ?? 0,
            $_POST['sf_guest'] ?? 0, $_POST['sf_theater'] ?? 0, $_POST['sf_courtyard'] ?? 0,
            $_POST['sf_staircase'] ?? 0, $_POST['sf_staircase_hall'] ?? 0,
            // Total areas
            $_POST['total_ground'] ?? 0, $_POST['total_first'] ?? 0, $_POST['total_second'] ?? 0
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Your house plan request has been submitted successfully! You will receive your PDF plan within 72 hours.']);
        
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error submitting form: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>