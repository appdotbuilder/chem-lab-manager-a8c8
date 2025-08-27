<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Lab;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = EquipmentCategory::all()->keyBy('code');
        $labs = Lab::all()->keyBy('code');

        $equipment = [
            // Analytical Instruments
            [
                'name' => 'Gas Chromatography Mass Spectrometer',
                'code' => 'GCMS-001',
                'category_id' => $categories['AI']->id,
                'lab_id' => $labs['ACL']->id,
                'description' => 'Advanced GC-MS system for qualitative and quantitative analysis of volatile and semi-volatile compounds.',
                'specifications' => [
                    'Detection Limit' => '1 ppb',
                    'Temperature Range' => '50-350°C',
                    'Injector' => 'Split/Splitless',
                    'Mass Range' => '1.5-1050 amu'
                ],
                'status' => 'available',
                'risk_level' => 'high',
                'requires_lecturer_approval' => true,
                'brand' => 'Agilent',
                'model' => '7890B-5977A',
                'serial_number' => 'AG2021001',
                'purchase_date' => '2021-03-15',
                'purchase_price' => 850000000,
                'usage_instructions' => 'Follow SOP for sample preparation and injection. Ensure proper carrier gas flow.',
                'safety_notes' => 'High temperature operation. Requires proper ventilation. Helium gas safety protocols apply.',
                'is_active' => true,
            ],
            [
                'name' => 'High Performance Liquid Chromatograph',
                'code' => 'HPLC-001',
                'category_id' => $categories['AI']->id,
                'lab_id' => $labs['ACL']->id,
                'description' => 'HPLC system for separation and analysis of non-volatile compounds.',
                'specifications' => [
                    'Flow Rate' => '0.1-10 mL/min',
                    'Pressure' => 'Up to 600 bar',
                    'Detector' => 'UV-Vis, Fluorescence',
                    'Injection Volume' => '1-100 μL'
                ],
                'status' => 'available',
                'risk_level' => 'medium',
                'requires_lecturer_approval' => false,
                'brand' => 'Shimadzu',
                'model' => 'LC-20A',
                'serial_number' => 'SH2020001',
                'purchase_date' => '2020-08-10',
                'purchase_price' => 450000000,
                'usage_instructions' => 'Prime system before use. Use appropriate mobile phase.',
                'safety_notes' => 'Handle solvents in fume hood. Proper waste disposal required.',
                'is_active' => true,
            ],
            [
                'name' => 'Fourier Transform Infrared Spectrometer',
                'code' => 'FTIR-001',
                'category_id' => $categories['AI']->id,
                'lab_id' => $labs['ACL']->id,
                'description' => 'FTIR spectrometer for molecular structure identification and functional group analysis.',
                'specifications' => [
                    'Wavenumber Range' => '4000-400 cm⁻¹',
                    'Resolution' => '0.5 cm⁻¹',
                    'Sample Compartment' => 'Heated',
                    'Detector' => 'DTGS'
                ],
                'status' => 'available',
                'risk_level' => 'low',
                'requires_lecturer_approval' => false,
                'brand' => 'PerkinElmer',
                'model' => 'Frontier',
                'serial_number' => 'PE2019001',
                'purchase_date' => '2019-11-20',
                'purchase_price' => 320000000,
                'usage_instructions' => 'Clean sample compartment before use. Use appropriate sampling technique.',
                'safety_notes' => 'Avoid moisture contamination. Handle samples carefully.',
                'is_active' => true,
            ],
            // Process Equipment
            [
                'name' => 'Jacketed Reactor System',
                'code' => 'JRS-001',
                'category_id' => $categories['PE']->id,
                'lab_id' => $labs['CREL']->id,
                'description' => 'Glass jacketed reactor with heating/cooling capability for batch reactions.',
                'specifications' => [
                    'Volume' => '5 L',
                    'Temperature Range' => '-20 to 200°C',
                    'Pressure Rating' => '5 bar',
                    'Material' => 'Borosilicate Glass'
                ],
                'status' => 'available',
                'risk_level' => 'high',
                'requires_lecturer_approval' => true,
                'brand' => 'Chemglass',
                'model' => 'CG-1990',
                'serial_number' => 'CG2020001',
                'purchase_date' => '2020-05-15',
                'purchase_price' => 125000000,
                'usage_instructions' => 'Check reactor integrity before use. Monitor temperature and pressure continuously.',
                'safety_notes' => 'High pressure and temperature operation. Use appropriate PPE. Emergency procedures posted.',
                'is_active' => true,
            ],
            [
                'name' => 'Continuous Stirred Tank Reactor',
                'code' => 'CSTR-001',
                'category_id' => $categories['PE']->id,
                'lab_id' => $labs['CREL']->id,
                'description' => 'Laboratory-scale CSTR for studying continuous reaction kinetics.',
                'specifications' => [
                    'Volume' => '2 L',
                    'Flow Rate' => '0.1-2 L/min',
                    'Agitation' => '100-1000 rpm',
                    'Material' => 'Stainless Steel 316'
                ],
                'status' => 'borrowed',
                'risk_level' => 'medium',
                'requires_lecturer_approval' => true,
                'brand' => 'Parr Instrument',
                'model' => '4570',
                'serial_number' => 'PI2021002',
                'purchase_date' => '2021-01-10',
                'purchase_price' => 180000000,
                'usage_instructions' => 'Ensure proper flow control. Monitor residence time.',
                'safety_notes' => 'Check for leaks before operation. Follow lockout/tagout procedures.',
                'is_active' => true,
            ],
            [
                'name' => 'Distillation Column',
                'code' => 'DC-001',
                'category_id' => $categories['PE']->id,
                'lab_id' => $labs['SPL']->id,
                'description' => 'Pilot-scale distillation column for separation studies.',
                'specifications' => [
                    'Height' => '3 m',
                    'Diameter' => '5 cm',
                    'Trays' => '20 sieve trays',
                    'Material' => 'Stainless Steel'
                ],
                'status' => 'available',
                'risk_level' => 'medium',
                'requires_lecturer_approval' => false,
                'brand' => 'Armfield',
                'model' => 'UOP5',
                'serial_number' => 'AF2020001',
                'purchase_date' => '2020-09-01',
                'purchase_price' => 95000000,
                'usage_instructions' => 'Establish proper vapor-liquid equilibrium. Monitor reflux ratio.',
                'safety_notes' => 'High temperature operation. Check for vapor leaks.',
                'is_active' => true,
            ],
            // Control Systems
            [
                'name' => 'Process Control Trainer',
                'code' => 'PCT-001',
                'category_id' => $categories['CS']->id,
                'lab_id' => $labs['PCL']->id,
                'description' => 'Comprehensive process control training system with multiple loops.',
                'specifications' => [
                    'Control Loops' => '4',
                    'I/O Points' => '32',
                    'Communication' => 'Modbus, Ethernet',
                    'Software' => 'LabVIEW based'
                ],
                'status' => 'available',
                'risk_level' => 'low',
                'requires_lecturer_approval' => false,
                'brand' => 'Feedback Instruments',
                'model' => 'PCT40',
                'serial_number' => 'FB2021001',
                'purchase_date' => '2021-07-20',
                'purchase_price' => 75000000,
                'usage_instructions' => 'Follow control loop configuration procedures. Save work regularly.',
                'safety_notes' => 'Electrical safety precautions. Do not modify hardware connections.',
                'is_active' => true,
            ],
            [
                'name' => 'Distributed Control System',
                'code' => 'DCS-001',
                'category_id' => $categories['CS']->id,
                'lab_id' => $labs['PCL']->id,
                'description' => 'Industrial-grade DCS for advanced process control studies.',
                'specifications' => [
                    'Processor' => 'Redundant',
                    'I/O Capacity' => '500 points',
                    'HMI Stations' => '4',
                    'Network' => 'Ethernet TCP/IP'
                ],
                'status' => 'maintenance',
                'risk_level' => 'medium',
                'requires_lecturer_approval' => true,
                'brand' => 'Honeywell',
                'model' => 'Experion PKS',
                'serial_number' => 'HW2022001',
                'purchase_date' => '2022-03-10',
                'purchase_price' => 550000000,
                'usage_instructions' => 'System administrator access required. Follow configuration management procedures.',
                'safety_notes' => 'Critical system - backup before modifications. Proper shutdown procedures required.',
                'is_active' => true,
            ],
            // Safety Equipment
            [
                'name' => 'Gas Detection System',
                'code' => 'GDS-001',
                'category_id' => $categories['SE']->id,
                'lab_id' => $labs['PCL']->id,
                'description' => 'Multi-gas detection system for laboratory safety monitoring.',
                'specifications' => [
                    'Gases Detected' => 'H2S, CO, LEL, O2',
                    'Response Time' => '< 30 seconds',
                    'Accuracy' => '±2% of reading',
                    'Display' => 'Digital LCD'
                ],
                'status' => 'available',
                'risk_level' => 'medium',
                'requires_lecturer_approval' => false,
                'brand' => 'BW Technologies',
                'model' => 'GasAlertMax XT II',
                'serial_number' => 'BW2021001',
                'purchase_date' => '2021-02-15',
                'purchase_price' => 15000000,
                'usage_instructions' => 'Calibrate before each use. Ensure sensors are clean.',
                'safety_notes' => 'Critical safety equipment. Report malfunctions immediately.',
                'is_active' => true,
            ],
            // Measurement Tools
            [
                'name' => 'Digital pH Meter',
                'code' => 'PHM-001',
                'category_id' => $categories['MT']->id,
                'lab_id' => $labs['ACL']->id,
                'description' => 'High-precision pH meter with automatic temperature compensation.',
                'specifications' => [
                    'pH Range' => '-2.000 to 20.000',
                    'Accuracy' => '±0.002 pH',
                    'Temperature' => '0-100°C',
                    'Calibration' => '1-5 points'
                ],
                'status' => 'available',
                'risk_level' => 'low',
                'requires_lecturer_approval' => false,
                'brand' => 'Hanna Instruments',
                'model' => 'HI-2020',
                'serial_number' => 'HI2020001',
                'purchase_date' => '2020-06-10',
                'purchase_price' => 8500000,
                'usage_instructions' => 'Calibrate with standard buffers. Clean electrode after use.',
                'safety_notes' => 'Handle glass electrode carefully. Proper storage solution required.',
                'is_active' => true,
            ],
            [
                'name' => 'Digital Balance',
                'code' => 'DB-001',
                'category_id' => $categories['MT']->id,
                'lab_id' => $labs['ACL']->id,
                'description' => 'Analytical balance for precise mass measurements.',
                'specifications' => [
                    'Capacity' => '220 g',
                    'Readability' => '0.1 mg',
                    'Linearity' => '±0.2 mg',
                    'Repeatability' => '0.1 mg'
                ],
                'status' => 'available',
                'risk_level' => 'low',
                'requires_lecturer_approval' => false,
                'brand' => 'Sartorius',
                'model' => 'Entris224-1S',
                'serial_number' => 'SA2021001',
                'purchase_date' => '2021-04-05',
                'purchase_price' => 25000000,
                'usage_instructions' => 'Level the balance before use. Avoid vibrations and air currents.',
                'safety_notes' => 'Handle samples carefully. Keep balance area clean.',
                'is_active' => true,
            ],
            // Additional equipment for complete seeding
            [
                'name' => 'Muffle Furnace',
                'code' => 'MF-001',
                'category_id' => $categories['HE']->id,
                'lab_id' => $labs['ACL']->id,
                'description' => 'High-temperature furnace for ashing and calcination.',
                'specifications' => [
                    'Max Temperature' => '1200°C',
                    'Chamber Size' => '20 x 20 x 30 cm',
                    'Heating Rate' => '10°C/min',
                    'Control' => 'PID controller'
                ],
                'status' => 'available',
                'risk_level' => 'high',
                'requires_lecturer_approval' => true,
                'brand' => 'Nabertherm',
                'model' => 'L9/11',
                'serial_number' => 'NB2020001',
                'purchase_date' => '2020-10-15',
                'purchase_price' => 45000000,
                'usage_instructions' => 'Program heating profile carefully. Use appropriate crucibles.',
                'safety_notes' => 'Extremely high temperature. Use heat-resistant PPE. Ensure proper ventilation.',
                'is_active' => true,
            ],
            [
                'name' => 'Overhead Stirrer',
                'code' => 'OS-001',
                'category_id' => $categories['ME']->id,
                'lab_id' => $labs['CREL']->id,
                'description' => 'Heavy-duty overhead stirrer for viscous solutions.',
                'specifications' => [
                    'Speed Range' => '30-2000 rpm',
                    'Torque' => '50 Ncm',
                    'Viscosity' => 'Up to 50,000 mPas',
                    'Display' => 'Digital'
                ],
                'status' => 'available',
                'risk_level' => 'low',
                'requires_lecturer_approval' => false,
                'brand' => 'IKA',
                'model' => 'RW20',
                'serial_number' => 'IK2021001',
                'purchase_date' => '2021-06-20',
                'purchase_price' => 12000000,
                'usage_instructions' => 'Secure stirrer shaft properly. Start at low speed.',
                'safety_notes' => 'Avoid splashing. Secure containers properly.',
                'is_active' => true,
            ],
            [
                'name' => 'Centrifuge',
                'code' => 'CF-001',
                'category_id' => $categories['SEP']->id,
                'lab_id' => $labs['SPL']->id,
                'description' => 'Benchtop centrifuge for sample preparation and separation.',
                'specifications' => [
                    'Max Speed' => '15000 rpm',
                    'Max RCF' => '21000 x g',
                    'Capacity' => '24 x 1.5 mL',
                    'Timer' => '1 sec - 99 min'
                ],
                'status' => 'available',
                'risk_level' => 'medium',
                'requires_lecturer_approval' => false,
                'brand' => 'Eppendorf',
                'model' => '5424R',
                'serial_number' => 'EP2020001',
                'purchase_date' => '2020-12-08',
                'purchase_price' => 35000000,
                'usage_instructions' => 'Balance tubes properly. Check rotor condition.',
                'safety_notes' => 'Keep lid closed during operation. Report unusual vibrations.',
                'is_active' => true,
            ],
            // More equipment for comprehensive testing
            [
                'name' => 'Vacuum Pump',
                'code' => 'VP-001',
                'category_id' => $categories['PE']->id,
                'lab_id' => $labs['SPL']->id,
                'description' => 'Rotary vane vacuum pump for distillation and filtration.',
                'specifications' => [
                    'Ultimate Vacuum' => '0.1 mbar',
                    'Pumping Speed' => '21 m³/h',
                    'Motor Power' => '1.5 kW',
                    'Oil Capacity' => '1.3 L'
                ],
                'status' => 'available',
                'risk_level' => 'medium',
                'requires_lecturer_approval' => false,
                'brand' => 'Edwards',
                'model' => 'E2M28',
                'serial_number' => 'ED2021001',
                'purchase_date' => '2021-08-30',
                'purchase_price' => 28000000,
                'usage_instructions' => 'Check oil level before operation. Use appropriate trap.',
                'safety_notes' => 'Ensure adequate ventilation. Regular oil changes required.',
                'is_active' => true,
            ],
            [
                'name' => 'Ultrasonic Bath',
                'code' => 'UB-001',
                'category_id' => $categories['ME']->id,
                'lab_id' => $labs['ACL']->id,
                'description' => 'Ultrasonic cleaning bath for sample preparation.',
                'specifications' => [
                    'Frequency' => '40 kHz',
                    'Power' => '240 W',
                    'Capacity' => '6 L',
                    'Temperature' => '20-80°C'
                ],
                'status' => 'available',
                'risk_level' => 'low',
                'requires_lecturer_approval' => false,
                'brand' => 'Elma',
                'model' => 'S60H',
                'serial_number' => 'EL2020001',
                'purchase_date' => '2020-07-25',
                'purchase_price' => 8000000,
                'usage_instructions' => 'Use appropriate cleaning solution. Avoid overheating.',
                'safety_notes' => 'Do not operate without liquid. Avoid direct contact with ultrasonic waves.',
                'is_active' => true,
            ],
        ];

        foreach ($equipment as $equipmentData) {
            // Generate QR code and barcode
            $equipmentData['qr_code'] = 'QR-' . $equipmentData['code'];
            $equipmentData['barcode'] = 'BC-' . $equipmentData['code'];
            
            Equipment::create($equipmentData);
        }
    }
}