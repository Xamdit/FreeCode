let messageRequire = 'This field is required';
let messageRequiredInvalid = 'Invalid character';
const req = {
    elementBonus: {
        'txtPromotionBonusAmount': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                }
            }
        },
        'txtPromotionBonusLimit': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                }
            }
        },
    },
    elementDepCount: {
        'txtPromotionDepDepositCountFrom': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                    message: messageRequiredInvalid
                }
            }
        },
        'txtPromotionDepDepositCountTo': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                    message: messageRequiredInvalid
                }

            }
        },
    },
    elementDepPerTime: {
        'txtPromotionDepDepositPerTimeFrom': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                    message: messageRequiredInvalid
                }

            }
        },
        'txtPromotionDepDepositPerTimeTo': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                    message: messageRequiredInvalid
                }

            }
        }
    },
    elementDepAmount: {
        'txtPromotionDepDepositAMonthFrom': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                    message: messageRequiredInvalid
                }

            }
        },
        'txtPromotionDepDepositAMonthTo': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                    message: messageRequiredInvalid
                }

            }
        }
    },
    elementTurnAmount: {
        'txtPromotionTurnOverTurnAMonthFrom': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                    message: messageRequiredInvalid
                }

            }
        },
        'txtPromotionTurnOverTurnAMonthTo': {
            validators: {
                notEmpty: {
                    message: messageRequire,
                },
                regexp: {
                    regexp: /^(([1-9]\d*(?:\.[0-9]{1,2})?)|(:?^0.[1-9]+0)|(:?^0.0+[1-9])|(:?^0.[1-9])|([0]{1}))$/gm,
                    message: messageRequiredInvalid
                }

            }
        },
    }
}