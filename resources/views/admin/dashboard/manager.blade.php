<div class="form-group row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Employees</h3>
                <h4 class="text-center">{{ $employees->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Salaries</h3>
                <h4 class="text-center">{{ number_format($employees->sum('salary') ?? 0) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Tasks</h3>
                <h4 class="text-center">{{ $tasks ?? 0 }}</h4>
            </div>
        </div>
    </div>
    
</div>