<div class="tabs-vertical-env">

    <ul class="nav tabs-vertical"><!-- available classes "right-aligned" -->
        <li class="active"><a href="#v-information" data-toggle="tab">Information</a></li>
        <li><a href="#v-players" data-toggle="tab">Players</a></li>
        <li><a href="#v-playerGather" data-toggle="tab">Player Gather</a></li>
        <li><a href="#v-playerKills" data-toggle="tab">Player Kills/Death</a></li>
        <li><a href="#v-playerWeaponFire" data-toggle="tab">Player Weapon Fire</a></li>
        <li><a href="#v-destroyedBuildings" data-toggle="tab">Destroyed Buildings</a></li>
        <li><a href="#v-destroyedContainers" data-toggle="tab">Destroyed Containers</a></li>
        <li><a href="#v-placedBuildings" data-toggle="tab">Placed Buildings</a></li>
        <li><a href="#v-placedDeployables" data-toggle="tab">Placed Deployables</a></li>
        <li><a href="#v-animalKills" data-toggle="tab">Animal Kills</a></li>
    </ul>

    <div class="tab-content">

        @include('archived.server.modules.information')

        @include('archived.server.modules.players')

        @include('archived.server.modules.playerGather')

        @include('archived.server.modules.playerKills')

        @include('archived.server.modules.playerWeaponFire')

        @include('archived.server.modules.destroyedBuildings')

        @include('archived.server.modules.destroyedContainers')

        @include('archived.server.modules.placedBuildings')

        @include('archived.server.modules.placedDeployables')

        @include('archived.server.modules.animalKills')

    </div>

</div>
