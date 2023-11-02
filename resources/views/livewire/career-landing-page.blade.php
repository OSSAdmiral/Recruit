<div class="crmga c4q7l c2yan cax0a cecw5">
    <!-- Page wrapper -->
    <div class="crp1m cjiiw cj2th c78an c069h">
        <!-- Site header -->
        <header class="c5u32 cy7bv coz82">
            <div class="cscbh cyd7h cctbj c1dhf">
                <div class="crp1m c7htb czlxp c7kkg cf6y5">

                    <!-- Site branding -->
                    <div class="cg571 cqfuo rounded-full shrink-0 grow-0 h-8 w-8">
                        <!-- Logo -->
                        <a class="cdfr0 cq3a6" href="#" aria-label="{{ filament()->getBrandName() }}">
                            @if ($favicon = filament()->getFavicon())
                                <img src="{{ $favicon }}" alt="{{ filament()->getBrandName() }}"/>
                            @endif
                        </a>
                    </div>

                    <!-- Desktop navigation -->
                    <nav class="crp1m cyy4k">
                        <!-- Desktop sign in links -->
                        <ul class="crp1m cyy4k cnk8m czlxp cp7rp">
                            <li>
                                <a class="crp1m czlxp chrwa cxa4q c9csv ckncn c0ndj c91mf chlg0" href="{{filament()->getPanel('candidate')->getLoginUrl()}}">Sign in</a>
                            </li>
                            <li>
                                <a class="crp1m czlxp chrwa cxa4q c9csv ckncn c0ndj c91mf chlg0" href="{{filament()->getPanel('candidate')->getRegistrationUrl()}}">Sign up</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="cyy4k">
            <section class="cpsdf c78an">
                <div class="cp8r2 c5u32 cdf7d cxio3 c0wb5 ch30j clp4d" aria-hidden="true"></div>
                <div class="cscbh cyd7h cctbj c1dhf">
                    <div class="c1id5 cw23l cehj8 cmgzk">
                        <!-- Hero content -->
                        <div class="clxxf cnvur cgr2r">
                            <!-- Copy -->
                            <h1 class="c80vv cmux8 c4q7l">Join with our team</h1>
                            <p class="cfnbb ckpvk clvg0">We know that finding a meaningful and rewarding job can be a
                                long journey. Our goal is to make that process as easy as possible for you, and to
                                create a work environment that's satisfying - one where you'll look forward to coming to
                                every day. Start your journey with us by browsing available jobs.</p>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Page content -->
            <section>
                <div class="cscbh cyd7h cctbj c1dhf">
                    <div class="cggc7 cx4jt">

                        <div class="cpeyd cbk09">
                            @if(isset($jobLists) && count($jobLists) > 0)
                                <aside class="cfnbb ckr3e cjj8z c5dnb cbk0u cgcix c8hmz cve1w">
                                    <div class="c8e4z c2q0g">

                                        <div class="cpsdf ckgol ciwnj cuiwd ccrxf ctokc">

                                            <div class="c5u32 ccs55 cgzf4 co4wt">
                                                <button class="c9csv ckncn c0ndj c91mf">Clear</button>
                                            </div>

                                            <div class="cfzub cu1y1 cnvfb c2et9">
                                                <div>
                                                    <div class="cv7ca c9csv ct75g cax0a">Remote Only</div>
                                                    <div class="crp1m czlxp" x-data="{ checked: false }">
                                                        <div class="c9jgf">
                                                            <input type="checkbox" id="remote-toggle" class="cqgiy"
                                                                   x-model="checked" wire:model.live="showRemote">
                                                            <label class="c0e8u" for="remote-toggle">
                                                                <span class="crmga c8dh7" aria-hidden="true"></span>
                                                                <span class="cqgiy">Remote Only</span>
                                                            </label>
                                                        </div>
                                                        <div class="cdjzc c9csv cqaaz cucxo"
                                                             x-text="checked ? 'On' : 'Off'"></div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="cv7ca c9csv ct75g cax0a">Job Type</div>
                                                    <ul class="c89f3">
                                                        @forelse($jobTypes as $index => $value)
                                                            <li>
                                                                <label class="crp1m czlxp">
                                                                    <input type="checkbox" class="cw1b8" wire:model.live="jobTypeFilter" value="{{$value['JobType']}}">
                                                                    <span class="cdjzc c9csv cqfq4">{{$value['JobType']}}</span>
                                                                </label>
                                                            </li>
                                                        @empty
                                                            <li>
                                                                <label class="crp1m czlxp">
                                                                    <span class="cdjzc c9csv cqfq4">no available filter</span>
                                                                </label>
                                                            </li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                            @endif

                            <!-- Sidebar -->


                            <!-- Main content -->
                            <div class="cj8w4">

                                <!-- Job list -->
                                <div class="c1id5 cehj8">
                                    <h2 class="cjplb c4q7l cp2cr cqnva">Latest jobs</h2>
                                    <!-- List container -->
                                    <div class="crp1m cj2th">
                                        <!-- Item -->
                                        @forelse($jobLists as $jobs)
                                            {{--<!-- Item -->--}}
                                            <div class="clyea c9l7w cq3a6 cesvj">
                                                <div class="cnm0k cwi2m">
                                                    <div class="cqho4 cttum cnq6h cfv99 c1jf4">
                                                        <div class="c8c54 cqho4 c1ls3 c4nmh cfzi6 cvz5l cxdqm">
                                                            <div>
                                                                <div class="cknhg font-bold">
                                                                    <a class="cbde7 c89yv c8tys" href="{{route('career.job_details', [$jobs['JobOpeningSystemID']])}}">{{$jobs['postingTitle']}}</a>
                                                                </div>
                                                                <div class="italic font-thin ">
                                                                    <p class="clvg0 text-xs mb-5">{{\Illuminate\Support\Str::limit($jobs['JobDescription'], 200)}}</p>
                                                                </div>
                                                                <div class="cvrk3">
                                                                    <p class="cwu8g c00re cx250 ckpu6 csdzj c7x38 cobkt cesao crqt4 cdfls cdo22 chdfx ct9wm cebbr">💰 {{$jobs['Salary']}}</p>
                                                                    <p class="cwu8g c00re cx250 ckpu6 csdzj c7x38 cobkt cesao crqt4 cdfls cdo22 chdfx ct9wm cebbr">💼 {{$jobs['JobType']}}</p>
                                                                    <p class="cwu8g c00re cx250 ckpu6 csdzj c7x38 cobkt cesao crqt4 cdfls cdo22 chdfx ct9wm cebbr">
                                                                        {{$jobs['RemoteJob'] === 1 ? '🌎 Remote' : '🏢 On-site'}}
                                                                        </p>
                                                                </div>
                                                            </div>
                                                            <div class="csqne c2kp1 cqho4 cn13m ctc7o ckjlt">
                                                                <div class="cguey czwdx">
                                                                    <a class="cmqi9 comj7 cr309 cebq5 c3fma cfkyn ch5p0 cq3a6" href="{{route('career.job_apply', [$jobs['JobOpeningSystemID']])}}">
                                                                        Apply Now <span class="c6gnl c8b8n cv4h1 ci5s6 chdfx ct9wm ciidb"></span>
                                                                    </a>
                                                                </div>
                                                                <div class="ckc7d c551r cdfls cdts2">{{\Carbon\Carbon::createFromTimeStamp(strtotime($jobs['created_at']))->diffForHumans()}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <span>There is no open job available.</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
