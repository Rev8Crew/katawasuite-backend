class KatawaSuite {
    url = '';
    game_short = '';
    csrf_token = '';
    game_id = '';

    constructor(url, game, csrf_token, game_id, jQuery) {
        this.url = url
        this.game_short = game
        this.csrf_token = csrf_token
        this.game_id = game_id

        this.$ = jQuery
    }

    get defaultPostData() {
        return {
            "_token": this.csrf_token
        }
    }

    getDefaultSlotName( game_short_name, slot) {
        return 'game_' + game_short_name + '_save' + '_' + slot
    }

    getSaveDataFromLocalStorageByGame(game) {
        let save_data = []

        Object.keys(localStorage).forEach((key) => {
            if (key.indexOf( 'game_' + this.game_short + '_save') !== -1) {
                const index = Number(key.replaceAll('game_' + this.game_short + '_save_', ''))
                const item = JSON.parse(localStorage.getItem(key))
                save_data.push({
                    '_slot' : index,
                    'data' : item['data'],
                    'game' : game,
                    'date' : item?.date || new Date().toLocaleString()
                })
            }
        })

        return save_data
    }

    async load() {
        let data = {
            game_id: this.game_id
        }

        this.clearSavesBeforeRequest()

        return this.request(this.url + 'web/games/sync', data).then((data) => {
            if (data) {
                for(const i in data) {
                    this.addSaveToSlotFromRequest(data[i])
                }
            }
        })
    }

    addSaveToSlotFromRequest(data) {
        localStorage.setItem( this.getDefaultSlotName(this.game_short, data.slot), JSON.stringify(data))
    }

    clearSavesBeforeRequest() {
        Object.keys(localStorage).forEach((key) => {
            if (key.indexOf( 'game_' + this.game_short + '_save') !== -1) {
                localStorage.removeItem(key)
            }
        })
    }
    addSaveToSlot( data, slot) {
        const key = this.getDefaultSlotName(this.game_short, slot)
        const save_game = {
            slot,
            data,
            game: this.game_short,
            date: new Date().toLocaleString()
        }

        localStorage.setItem(key, JSON.stringify(save_game))
    }

    async startTimeTracker() {
        let data = {
            game_id: this.game_id
        }

        return this.request(this.url + 'web/statistic/time-tracker/start', data)
    }

    async endTimeTracker() {
        let data = {
            game_id: this.game_id
        }

        return this.request(this.url + 'web/statistic/time-tracker/end', data)
    }

    addStatistic( option, value = '') {
        const url = 'web/statistic/add-user-statistic-game';

        const data = {
            game_id: this.game_id,
            option,
            value
        }

        return this.request(this.url + url, data)
    }

    async completeAchieve(achieve_short) {
        return this.request(this.url + 'web/achievements/complete', { short: achieve_short})
    }

    async save() {
        let data = {
            game_id: this.game_id,
            data: JSON.stringify(this.getSaveDataFromLocalStorageByGame(this.game_short))
        }

        return this.request(this.url + 'web/games/sync', data).then((data) => {
            if (data) {
                for(const i in data) {
                    this.addSaveToSlotFromRequest(data[i])
                }
            }
        })
    }

    formatAssetUrl(value) {
        return value.indexOf(window.laravel.url) !== -1 ? value : (window.laravel.url +value)
    }

    asset(url) {
        return this.$.get( this.formatAssetUrl(url))
    }

    request(url, request_data = {}) {
        const data = Object.assign({}, request_data, this.defaultPostData)
        return new Promise((resolve, reject) => {
                this.$.post(url, data).done(function (data) {
                    resolve(data.data)
                })
        })
    }
}
