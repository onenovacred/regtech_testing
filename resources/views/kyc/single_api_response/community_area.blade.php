@if(isset($community_details['statusCode']) && $community_details['statusCode'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Community Area Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>Title:</strong>{{ isset($community_details['data']['page']) ? $community_details['data']['page'] : 'null' }}
                        </p>
                        <p><strong>Temple Count:</strong>{{ isset($community_details['data']['temple_count']) ?$community_details['data']['temple_count'] : 'null' }}
                        </p>
                        <p><strong>Church Count:</strong>{{ isset($community_details['data']['church_count']) ? $community_details['data']['church_count'] : 'null' }}
                        </p>
                        <p><strong>Mosque Count:</strong>{{ isset($community_details['data']['mosque_count']) ?$community_details['data']['mosque_count']: 'null' }}
                        </p>
                        <p><strong>Gurudwara Count:</strong>{{ isset($community_details['data']['gurudwara_count']) ?$community_details['data']['gurudwara_count']: 'null' }}
                        </p>
                        <p><strong>Timestamp:</strong>{{ isset($community_details['data']['Timestamp']) ? \Carbon\Carbon::createFromTimestamp($community_details['data']['Timestamp'])->format('Y-m-d') : 'null' }}
                        </p>
                   </div>
                 </div>
            </div>
            </div>
        </div>
    </div>
</div>
        @endif  