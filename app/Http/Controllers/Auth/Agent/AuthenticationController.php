<?php

namespace App\Http\Controllers\Auth\Agent;

use App\Enums\Bucket;
use App\Models\Agent;
use App\Traits\Uploader;
use App\Traits\HttpResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AgentLoginRequest;
use App\Http\Requests\AgentRegisterRequest;

class AuthenticationController extends Controller
{
    use HttpResponse,Uploader;
    /**
     * register function of agent.
     */
    public function register(AgentRegisterRequest $request)
    {
        $data = $request->validated();
        $data['agent_id'] = uniqid();
        $data['password'] = Hash::make($data['password']);
        $agent = Agent::create($data);
        $this->upload($request, 'image', $agent->getKey(), Bucket::AGENT, Agent::class);
        $this->upload($request, 'document', $agent->getKey(), Bucket::DOCUMENT, Agent::class);

        return $this->success([
            'agent' => $agent,
            'token' => $agent->createToken('API Token of ' . $agent->full_name)->plainTextToken,
        ]);
    }

     /**
     * login into agent dashboard.
     */
    public function login(AgentLoginRequest $request)
    {
        $request->validated($request->all());
        if (!Auth::guard('agent')->attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials do not match to agent', 401);
        }

        $agent = Agent::where('email', $request->email)->first();
        return $this->success([
            'merchant' => $agent,
            'token' => $agent->createToken('API Token of' . $agent->full_name)->plainTextToken,
        ]);
    }
}
