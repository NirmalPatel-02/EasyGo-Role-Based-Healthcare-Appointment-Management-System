<?php 
namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportUsersExcel($users)
    {
        // File name for download
        $fileName = 'users_export_' . date('Ymd_His') . '.csv';
    
        // Set headers for download
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];
    
        // Callback to write the data to the output stream
        $callback = function () use ($users) {
            $file = fopen('php://output', 'w');
    
            // Determine and write headers dynamically
            $headerColumns = ['ID', 'First Name', 'Last Name', 'Phone', 'Email'];
            if ($users->firstWhere('role', 'doctor')) {
                $headerColumns = array_keys($users->firstWhere('role', 'doctor')->toArray());
            }
            fputcsv($file, $headerColumns);
    
            // Write user data rows
            foreach ($users as $user) {
                if ($user->role === 'client') {
                    // Export specific fields for clients
                    $row = [
                        'ID' => $user->id,
                        'First Name' => $user->first_name,
                        'Last Name' => $user->last_name,
                        'Phone' => $user->phone,
                        'Email' => $user->email,
                    ];
                } elseif ($user->role === 'doctor') {
                    // Export all fields for doctors
                    $row = $user->toArray();
                } else {
                    continue; // Skip if the role doesn't match
                }
                fputcsv($file, $row);
            }
    
            fclose($file);
        };
    
        // Return response as a stream
        return response()->stream($callback, 200, $headers);
    }
    
public function exportExcelAppointments($appointments)
{
    // File name for download
    $fileName = 'appointments_export_' . date('Ymd_His') . '.csv';

    // Set headers for download
    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0",
    ];

    // Callback to write the data to the output stream
    $callback = function () use ($appointments) {
        $file = fopen('php://output', 'w');

        // Write the header row for the export CSV
        $csvHeader = [
            'Client Name',
            'Client Phone',
            'Doctor Name',
            'Doctor Phone',
            'Doctor City',
            'Time Slot',
            'Date',
            'Status',
            'Rescheduled',
            'Payment ID',
            'First Name',
            'Last Name',
            'DOB',
            'Gender',
            'Doctor Price',
            'GST Percent',
            'GST Amount',
            'Platform Fee',
            'Commission Rate',
            'Total Amount',
            'Commission Amount',
            'Order ID'
        ];
        fputcsv($file, $csvHeader);

        // Write data rows for each appointment
        foreach ($appointments as $appointment) {
            // Collecting data for each appointment
            $row = [
                'Client Name' => $appointment->client ? $appointment->client->first_name . ' ' . $appointment->client->last_name : 'N/A',
                'Client Phone' => $appointment->client ? $appointment->client->phone : 'N/A',
                'Doctor Name' => $appointment->doctor ? $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name : 'N/A',
                'Doctor Phone' => $appointment->doctor ? $appointment->doctor->phone : 'N/A',
                'Doctor City' => $appointment->doctor ? $appointment->doctor->city : 'N/A',
                'Time Slot' => $appointment->time_slot,
                'Date' => $appointment->dated,
                'Status' => $appointment->status,
                'Rescheduled' => $appointment->rescheduled,
                'Payment ID' => $appointment->payment_id,
                'First Name' => $appointment->first_name,
                'Last Name' => $appointment->last_name,
                'DOB' => $appointment->dob,
                'Gender' => $appointment->gender,
                'Doctor Price' => $appointment->doctor_price,
                'GST Percent' => $appointment->gst_percent,
                'GST Amount' => $appointment->gst_amount,
                'Platform Fee' => $appointment->platform_fee,
                'Commission Rate' => $appointment->commission_rate,
                'Total Amount' => $appointment->total_amount,
                'Commission Amount' => $appointment->commission_amount,
                'Order ID' => $appointment->order_id,
            ];

            fputcsv($file, $row);
        }

        fclose($file);
    };

    // Return response as a stream
    return response()->stream($callback, 200, $headers);
}
public function exportWithdrawalsExcel($withdrawals)
{
    // File name for download
    $fileName = 'withdrawals_export_' . date('Ymd_His') . '.csv';

    // Set headers for download
    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0",
    ];

    // Callback to write the data to the output stream
    $callback = function () use ($withdrawals) {
        $file = fopen('php://output', 'w');

        // Write the header row for the export CSV
        $csvHeader = [
            'ID',
            'Dated',
            'Processed',
            'Status',
            'Doctor ID',
            'Doctor Name',
            'Phone',
            'Bank Name',
            'Holder Name',
            'Account No',
            'IFSC',
            'Branch Name',
            'Transaction ID',
            'Remarks',
        ];
        fputcsv($file, $csvHeader);

        // Write data rows for each withdrawal
        foreach ($withdrawals as $withdrawal) {
            // Collecting data for each withdrawal
            $row = [
                'ID' => $withdrawal->id,
                'Dated' => $withdrawal->created_at->format('Y-m-d'),
                'Processed' => $withdrawal->updated_at ? $withdrawal->updated_at->format('Y-m-d') : 'N/A',
                'Status' => $withdrawal->status,
                'Doctor ID' => $withdrawal->doctor_id,
                'Doctor Name' => $withdrawal->doctor ? $withdrawal->doctor->name : 'N/A',
                'Phone' => $withdrawal->doctor ? $withdrawal->doctor->phone : 'N/A',
                'Bank Name' => $withdrawal->bank_name,
                'Holder Name' => $withdrawal->holder_name,
                'Account No' => $withdrawal->account_no,
                'IFSC' => $withdrawal->ifsc,
                'Branch Name' => $withdrawal->branch_name,
                'Transaction ID' => $withdrawal->transaction_id,
                'Remarks' => $withdrawal->remarks,
            ];

            fputcsv($file, $row);
        }

        fclose($file);
    };

    // Return response as a stream
    return response()->stream($callback, 200, $headers);
}

public function exportReviewsExcel($reviews)
{
    // File name for download
    $fileName = 'reviews_export_' . date('Ymd_His') . '.csv';

    // Set headers for download
    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0",
    ];

    // Callback to write the data to the output stream
    $callback = function () use ($reviews) {
        $file = fopen('php://output', 'w');

        // Write the header row for the export CSV
        $csvHeader = [
            'Review ID',
            'Client Name',
            'Client Phone',
            'Doctor Name',
            'Doctor Phone',
            'Appointment Date',
            'Time Slot',
            'Created At',
            'Rating',
            'Comments'
        ];
        fputcsv($file, $csvHeader);

        // Write review data rows
        foreach ($reviews as $review) {
            $row = [
                'Review ID' => $review->id,
                'Client Name' => $review->client ? $review->client->first_name . ' ' . $review->client->last_name : 'N/A',
                'Client Phone' => $review->client ? $review->client->phone : 'N/A',
                'Doctor Name' => $review->doctor ? $review->doctor->first_name . ' ' . $review->doctor->last_name : 'N/A',
                'Doctor Phone' => $review->doctor ? $review->doctor->phone : 'N/A',
                'Appointment Date' => $review->appointment ? $review->appointment->dated : 'N/A',
                'Time Slot' => $review->appointment ? $review->appointment->time_slot : 'N/A',
                'Created At' => $review->created_at,
                'Rating' => $review->rating, // assuming 'rating' column exists
                'Comments' => $review->comments // assuming 'comments' column exists
            ];

            fputcsv($file, $row);
        }

        fclose($file);
    };

    // Return response as a stream
    return response()->stream($callback, 200, $headers);
}




public function exportWalletsExcel($wallets)
{
    // File name for download
    $fileName = 'wallets_export_' . date('Ymd_His') . '.csv';

    // Set headers for download
    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0",
    ];

    // Callback to write the data to the output stream
    $callback = function () use ($wallets) {
        $file = fopen('php://output', 'w');

        // Write the header row for the export CSV
        $csvHeader = [
            'Client Name',
            'Client Phone',
            'Doctor Name',
            'Doctor Phone',
            'Doctor City',
            'Payment ID',
            'Price',
            'CreatedAt',
            'Debit',
            'Credit',
            'Details',
            
            
        ];
        fputcsv($file, $csvHeader);

        // Write data rows for each appointment
        foreach ($wallets as $wallet) {
            // Collecting data for each wallet
            $row = [
                'Client Name' => $wallet->client ? $wallet->client->first_name . ' ' . $wallet->client->last_name : 'N/A',
                'Client Phone' => $wallet->client ? $wallet->client->phone : 'N/A',
                'Doctor Name' => $wallet->doctor ? $wallet->doctor->first_name . ' ' . $wallet->doctor->last_name : 'N/A',
                'Doctor Phone' => $wallet->doctor ? $wallet->doctor->phone : 'N/A',
                'Doctor City' => $wallet->doctor ? $wallet->doctor->city : 'N/A',
                'Payment ID' => $wallet->payment_id,
                'Price' => $wallet->charges,
                'CreatedAt' => $wallet->created_at,
                'Debit' => $wallet->debit,
                'Credit' => $wallet->credit,
                'Details' => $wallet->details,
            ];

            fputcsv($file, $row);
        }

        fclose($file);
    };

    // Return response as a stream
    return response()->stream($callback, 200, $headers);
}

public function exportIncomesExcel($wallets)
{
    // File name for download
    $fileName = 'incomes_export_' . date('Ymd_His') . '.csv';

    // Set headers for download
    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0",
    ];

    // Callback to write the data to the output stream
    $callback = function () use ($wallets) {
        $file = fopen('php://output', 'w');
       
        // Write the header row for the export CSV
        $csvHeader = [
            'Date',
            'Doctor Name',
            'Price',
            'GSTAmount',
            'PlatformFee',
            'CommissionAmount',
            'TotalAmount',
            'Payment ID',
        ];
        fputcsv($file, $csvHeader);

        // Write data rows for each appointment
        foreach ($wallets as $wallet) {
            // Collecting data for each wallet
            $row = [
                'Date'=>$wallet->created_at,
                'Doctor Name' => $wallet->doctor ? $wallet->doctor->first_name . ' ' . $wallet->doctor->last_name : 'N/A',
                'Price'=>$wallet->doctor_price,
                'GSTAmount'=>$wallet->gst_amount,
                'PlatformFee'=>$wallet->platform_fee,
                'CommissionAmount'=>$wallet->commission_amount,
                'TotalAmount'=>$wallet->total_amount,
                'Payment ID'=>$wallet->payment_id,
            ];

            fputcsv($file, $row);
        }

        fclose($file);
    };

    // Return response as a stream
    return response()->stream($callback, 200, $headers);
}

}