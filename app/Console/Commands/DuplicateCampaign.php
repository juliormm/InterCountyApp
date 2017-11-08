<?php

namespace App\Console\Commands;

use App\Assigned;
use App\Campaign;
use App\Tracking;
use Illuminate\Console\Command;

class DuplicateCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:duplicateCampaign {fromID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pass the {ID} for the campaign you want to duplicate';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $loadID = Assigned::where('campaign_id', $this->argument('fromID'))->get();

        if ($loadID->isEmpty()) {
            $this->info("No matching campaign found with ID: {$this->argument('fromID')}");
        } else {
            $grouped = $loadID->groupBy('store_name');

            if ($this->confirm('Do you want to create new campaign with copy data?')) {
                 $newCampName = $this->ask('Type name for new campaign');
                 
                 $newCamp = new Campaign;
                 $newCamp->name = $newCampName;
                 $newCamp->save();

                 $status = DuplicateCampaignAssigned::insertData($grouped, $newCamp->id);
                $this->info("New Campaign Created");
            } else {

                if ($this->confirm('Do you want overwrite a campaign?')) {
                     $repCamp = $this->ask('type campaign ID');

                     $toCamp = Campaign::find($repCamp);
                     if($toCamp){
                         $this->error("Campaign Found! the following campaign will be overwitten");
                         if ($this->confirm('Do you want to continue?')) {
                             
                             $storeIDs = Assigned::where('campaign_id', $repCamp)->pluck('id');

                             if (!empty($storeIDs)) {
                                $AssignedDelete = Assigned::destroy($storeIDs->toArray());
                                $trackingDelete = Tracking::where('campaign_id', $repCamp)->delete();

                                $status = DuplicateCampaignAssigned::insertData($grouped, $repCamp);
                                $this->info("Campaign Updated");

                             } else {
                                $this->error("failed to complete");
                             }
                        } else {
                            $this->info("END");
                        }
                     } else {
                        $this->error("Could not find ".$toCamp);
                     }
                } else {
                    $this->info("END");
                }
            }
        }

    }

    public function insertData($data, $campaignID)
    {
        foreach ($data as $storeName => $rowArr) {

            foreach ($rowArr as $storeInfo) {
                $newAssign              = new Assigned;
                $newAssign->campaign_id = $campaignID;
                $newAssign->store_id    = $storeInfo->store_id;
                $newAssign->brand_id    = $storeInfo->brand_id;
                $newAssign->exit_url    = $storeInfo->exit_url;
                $newAssign->save();
            }

            if (!empty($rowArr[0]->creativeid)) {
                $newTrack              = new Tracking;
                $newTrack->creative_id = $rowArr[0]->creativeid;
                $newTrack->store_id    = $rowArr[0]->store_id;
                $newTrack->campaign_id = $campaignID;
                $newTrack->save();
            }
        }
        
        return true;
    }
}
