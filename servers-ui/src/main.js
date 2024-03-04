import './style.css'


import Alpine from 'alpinejs'

window.Alpine = Alpine


Alpine.store('vars',{
    apiBaseUrl: 'http://localhost:8181/api/v1',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
})

Alpine.data('servers', () => {
    return ({
        isLoading: false,
        servers: [],
        serversQuery: [],
        init() {
            this.isLoading = true
            this.fetchServers()

            window.addEventListener('location-changed', (evt) => {
                this.serversQuery['location'] = evt.detail
                this.fetchServers()
            })
            window.addEventListener('ram-changed', (evt) => {
                this.serversQuery['ram'] = evt.detail
                this.fetchServers()
            })
            window.addEventListener('storage-type-changed', (evt) => {
                this.serversQuery['hdd_type'] = evt.detail
                this.fetchServers()
            })
            window.addEventListener('storage-changed', (evt) => {
                this.serversQuery['storage'] = evt.detail
                this.fetchServers()
            })


        },
        fetchServers() {
            let url = this.buildUrl()
            fetch(`${Alpine.store('vars').apiBaseUrl}${url}`,
                {
                    headers: Alpine.store('vars').headers
                }
            )
                .then(res => res.json())
                .then(data => {
                    this.isLoading = false;
                    this.servers = data;
                    this.$dispatch('servers-list-loaded', this.servers.length)
                })
                .catch((error) => {
                    this.isLoading = false;
                });
        },
        buildUrl() {
            let query = [];
            for (let key in this.serversQuery) {
                let value = this.serversQuery[key];
                if (Array.isArray(value)) {
                    for (let i = 0; i < value.length; i++) {
                        query.push(`${key}[${i}]=${value[i]}`);
                    }
                } else {
                    query.push(encodeURIComponent(key) + '=' + encodeURIComponent(this.serversQuery[key]));
                }
            }
            let newUrl = "/servers" + (query.length ? '?' + query.join('&') : '');
            return (newUrl);
        },
    });
});

Alpine.data('locationOptions', () => ({
    isLoading: false,
    selectedLocation: '',
    locations: [],
    init() {
        this.isLoading = true
        fetch(`${Alpine.store('vars').apiBaseUrl}/options/locations`,
            {
                headers: Alpine.store('vars').headers
            })
            .then(res => res.json())
            .then(data => {
                this.isLoading = false;
                this.locations = data;
            })
            .catch((error) => {
                this.isLoading = false;
            });
    },
    onChangeLocation(evt) {
        this.$dispatch('location-changed', this.selectedLocation)
    }
}));

Alpine.data('storageTypes', () => ({
    isLoading: false,
    storageTypesOptions: [],
    selectedStorageType: '',
    init() {
        this.isLoading = true
        fetch(`${Alpine.store('vars').apiBaseUrl}/options/hdd-type`,
            {
                headers: Alpine.store('vars').headers
            })
            .then(res => res.json())
            .then(data => {
                this.isLoading = false;
                this.storageTypesOptions = data;
            })
            .catch((error) => {
                this.isLoading = false;
            });
    },
    onChangeStorageType(evt) {
        this.$dispatch('storage-type-changed', this.selectedStorageType)
    }
}));

Alpine.data('ramTypes', () => ({
    isLoading: false,
    ramOptions: [],
    selectedOption: null,
    selectedRam: [],
    init() {
        this.isLoading = true
        fetch(`${Alpine.store('vars').apiBaseUrl}/options/ram-type`,
            {
                headers: Alpine.store('vars').headers
            })
            .then(res => res.json())
            .then(data => {
                this.isLoading = false;
                this.ramOptions = data;
            })
            .catch((error) => {
                this.isLoading = false;
            });
    },
    onClickRamType(evt) {
        this.$dispatch('ram-changed', this.selectedRam)
    }
}));

Alpine.data('storage', () => ({
    isLoading: false,
    storageOptions: [],
    selectedMinSize: '',
    selectedMaxSize: '',
    init() {
        this.isLoading = true
        fetch(`${Alpine.store('vars').apiBaseUrl}/options/storage`,
            {
                headers: Alpine.store('vars').headers
            })
            .then(res => res.json())
            .then(data => {
                this.isLoading = false;
                this.storageOptions = data;
            })
            .catch((error) => {
                this.isLoading = false;
            });
    },

    onChangeSize(evt) {
        if(this.selectedMinSize && this.selectedMaxSize){
            this.$dispatch('storage-changed', [this.selectedMinSize, this.selectedMaxSize])
        }
    }
}));

Alpine.start()