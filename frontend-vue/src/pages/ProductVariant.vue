<template>

    <div></div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Product Code : Variant Name</div>
                    <div class="card-title">Web Product Code : Variant Long Text</div>
                    <div class="card-text"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Variant Name</div>
                    <div class="card-text">Variant Long Text</div>
                </div>
            </div>

        </div>
        <div class="col-md-4">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Variant Name</div>
                    <div class="card-text">Variant Long Text</div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    
}
</script>

<style lang="scss">
    .row{
        height: 250px;
        padding: 30px 100px;

        .col-md-4 {
            border: 1px solid lightgray;
            // padding : 50px;
        }
    }
</style>