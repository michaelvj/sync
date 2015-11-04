<div class="carousel slide" data-ride="carousel" id="carousel">
    <div class="carousel-inner">
        <section class="panel panel-default widget weather item active">
            <div class="panel-heading text-center">
                <h4 class="panel-title">
                    <a class="pull-left data-slide" href="#carousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    Weerbericht
                    <a class="pull-right data-slide" href="#carousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </h4>
            </div>
            <div class="panel-body">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 day day-0">
                            <p class="h1 temp"></p>
                            <p class="h3 condition"></p>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-xs-6 day day-1">
                            <p class="h3 temp"></p>
                            <p class="h4 condition"></p>
                            <p class="h4 text-muted" >Morgen</p>
                        </div>
                        <div class="col-xs-6 day day-2">
                            <p class="h3 temp"></p>
                            <p class="h4 condition"></p>
                            <p class="h4 text-muted">Overmorgen</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="panel panel-default widget countdown item">
            <div class="panel-heading text-center">
                <h4 class="panel-title">
                    <a class="pull-left data-slide" href="#carousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    Vakantie
                    <a class="pull-right data-slide" href="#carousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </h4>
            </div>
            <div class="panel-body">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 day">
                            <p class="h1 title"></p>
                            <p class="h3 description text-muted"></p>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12 day">
                            <p class="h3 days"></p>
                            <p class="h4 time text-muted"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <ol class="carousel-indicators panel-footer">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
    </ol>
</div>

@section('script')
<script>
    $(document).ready(function () {
        $('.carousel').carousel({
            interval: 10000
        });
    });
</script>
@stop