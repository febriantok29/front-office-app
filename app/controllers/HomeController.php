<?php
/**
 * Home Controller
 * 
 * Handles homepage and dashboard functionality
 */
class HomeController extends Controller {
    
    /**
     * Display the homepage
     */
    public function index() {
        // You can add data here to display stats on the homepage
        $data = [
            'title' => 'Beranda - Sistem Front Office',
            'visitors_today' => 25, // This would normally come from a model
            'active_meetings' => 12,
            'employee_count' => 42
        ];
        
        $this->render('dashboard/index', $data);
    }
}