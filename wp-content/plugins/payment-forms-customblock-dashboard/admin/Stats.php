<?php

class Stats
{
    protected $stripeApiKey;

    public function __construct($stripeApiKey)
    {
        $this->stripeApiKey = $stripeApiKey;
    }

    public function getChargeList($limit)
    {
        Stripe\Stripe::setApiKey($this->stripeApiKey);
        $charges = Stripe\Charge::all(['limit' => $limit]);
        return $charges;
    }

    public function getTotalAmount($list)
    {
        $totalAmount = [
            'paid' => 0,
            'failed' => 0
        ];

        foreach ($list as $charge) {
            if ($charge->paid) {
                $totalAmount['paid'] += $charge->amount;
            } else {
                $totalAmount['failed'] += $charge->amount;
            }
        }

        if ($totalAmount['paid'] > 0) {
            $totalAmount['paid'] = $totalAmount['paid']/100;
        }

        if ($totalAmount['failed'] > 0) {
            $totalAmount['failed'] = $totalAmount['failed']/100;
        }

        return $totalAmount;
    }
}
?>
