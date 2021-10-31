<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Campaign::latest()->paginate(5);
        return view('campaign.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_from' => 'required',
            'date_to' => 'required',
            'name' => 'required|min:3|max:255',
            'total_budget' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'daily_budget' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $request->all();
        if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $campaignImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $campaignImage);
            $input['image'] = "$campaignImage";
        }
        Campaign::create($input);
        return redirect()->route('campaigns.index')->with('success','Campaign created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return view('campaign.show',compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaign.edit',compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'date_from' => 'required',
            'date_to' => 'required',
            'name' => 'required|min:3|max:255',
            'total_budget' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'daily_budget' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        $input = $request->all();
        if ($image = $request->file('image')) {
            // $imageDestinationPath = 'uploads/';
            $campaignImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($imageDestinationPath, $campaignImage);
            $input['image'] = "$campaignImage";
        }else{
            unset($input['image']);
        }
        $campaign->update($input);
        return redirect()->route('campaigns.index')->with('success','Campaign updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaigns.index')
        ->with('success','Campaign deleted successfully');
    }
}
