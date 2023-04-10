<div class="progress__bar progress__bar-1x">
    <div class="progress__bar-item active">
      <div class="progress__bar-item-ball">
        <p class=" font-body--md-400 count-number count-number-active " > 01 </p>
        <span class="check-mark">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </span>
      </div>
      <h2 class="font-body--md-400">Order received</h2>
    </div>

    <div class="progress__bar-item @if(in_array($status,['processing','shipped','delivered','completed'])) active @endif">
      <div class="progress__bar-item-ball">
        <p class=" font-body--md-400 count-number count-number-active " > 02 </p>
        <span class="check-mark">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </span>
      </div>
      <h2 class="font-body--md-400">Processing</h2>
    </div>
    @if($status == 'cancelled')
      <div class="progress__bar-item  active ">
        <div class="progress__bar-item-ball bg-danger border-danger">
          <p class=" font-body--md-400 count-number count-number-active " > 02 </p>
          <span class="check-mark">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
        </div>
        <h2 class="font-body--md-400 text-danger">Cancelled</h2>
      </div>

    @else
      <div class="progress__bar-item @if(in_array($status,['shipped','delivered','completed'])) active @endif">
        <div class="progress__bar-item-ball">
          <p class=" font-body--md-400 count-number count-number-active " > 03 </p>
          <span class="check-mark">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
        </div>
        <h2 class="font-body--md-400">Shipped for Delivery</h2>
      </div>

      <div class="progress__bar-item @if(in_array($status,['delivered','completed'])) active @endif">
        <div class="progress__bar-item-ball">
          <p class=" font-body--md-400 count-number count-number-active " > 04 </p>
          <span class="check-mark">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
        </div>
        <h2 class="font-body--md-400">Delivered</h2>
      </div>

      @if(!in_array($status,['rejected','returned','refunded','disputed','closed']))
        <div class="progress__bar-item @if($status == 'completed') active @endif">
          <div class="progress__bar-item-ball">
            <p class=" font-body--md-400 count-number count-number-active " > 05 </p>
            <span class="check-mark">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </span>
          </div>
          <h2 class="font-body--md-400">Completed</h2>
        </div>
      @endif

      @if(in_array($status,['rejected','returned','refunded','disputed','closed']))
        <div class="progress__bar-item active ">
          <div class="progress__bar-item-ball bg-danger border-danger">
            <p class=" font-body--md-400 count-number count-number-active " > 05 </p>
            <span class="check-mark">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </span>
          </div>
          <h2 class="font-body--md-400 text-danger">Rejected</h2>
        </div>

        <div class="progress__bar-item @if(in_array($status,['returned','refunded'])) active @endif">
          <div class="progress__bar-item-ball">
            <p class=" font-body--md-400 count-number count-number-active " > 06 </p>
            <span class="check-mark">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </span>
          </div>
          <h2 class="font-body--md-400">Returned</h2>
        </div>
        
        @if(!in_array($status,['disputed','closed']))
          <div class="progress__bar-item @if($status == 'refunded') active @endif">
            <div class="progress__bar-item-ball">
              <p class=" font-body--md-400 count-number count-number-active " > 07 </p>
              <span class="check-mark">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </span>
            </div>
            <h2 class="font-body--md-400">Refunded</h2>
          </div>
        @endif

        @if(in_array($status,['disputed','closed']))
          <div class="progress__bar-item active @if(in_array($status,['disputed','closed'])) active @endif">
            <div class="progress__bar-item-ball bg-warning border-warning">
              <p class=" font-body--md-400 count-number count-number-active " > 07 </p>
              <span class="check-mark">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </span>
            </div>
            <h2 class="font-body--md-400 text-danger">Disputed</h2>
          </div>

          <div class="progress__bar-item active @if($status == 'closed') active @endif">
            <div class="progress__bar-item-ball">
              <p class=" font-body--md-400 count-number count-number-active " > 08 </p>
              <span class="check-mark">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16.6663 5.83301L7.49967 14.9997L3.33301 10.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </span>
            </div>
            <h2 class="font-body--md-400 text-danger">Closed</h2>
          </div>
        @endif
      @endif
    @endif

  </div>