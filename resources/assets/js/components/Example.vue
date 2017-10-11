<template>
    <div class="col-sm-4">
        <div class="thumbnail">
            <div class="overlay">
                <i class="fa fa-share md"></i>
            </div>
            <img class="img-responsive" alt="a" src="http://placehold.it/350x350">
        </div>
        <div class="row">
            <div class="col-md-3">
                <h3><span class="label label-info">Jul 22</span></h3>
            </div>
            <div class="col-md-9">
                <strong>Learning Mobile Development</strong><br>
                <a href="#">View event page</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
